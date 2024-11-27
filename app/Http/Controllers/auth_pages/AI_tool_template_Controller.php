<?php

namespace App\Http\Controllers\auth_pages;

use App\Http\Controllers\Controller;
use App\Models\Apiskey;
use App\Models\Recent_tool;
use App\Models\Subscription;
use App\Models\Token_tracker;
use App\Models\Tool;
use App\Models\Tools_data;
use Illuminate\Support\Facades\DB;
use App\Models\Tools_feild;
use App\Models\Tools_feild_custom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use ArdaGnsrn\ElevenLabs;
use ArdaGnsrn\ElevenLabs\ElevenLabs as ElevenLabsElevenLabs;
use ArdaGnsrn\ElevenLabs\Facades\ElevenLabs as FacadesElevenLabs;

class AI_tool_template_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {  

        $recent = Recent_tool::where('id_tool', $id)->where('id_user',Auth::user()->id)->first();
        if ($recent) {
            $recent->id_user = Auth::user()->id;
            $recent->id_tool = $id;
            $recent->updated_at = now();
            $recent->save();
        } else {

            $recent = new Recent_tool();
            $recent->id_user = Auth::user()->id;
            $recent->id_tool = $id;
            $recent->save();
        }

        $userID = Auth::user()->id;

        $pages_sub = Tool::select('tools.*','favorite_tools.id_tool')
        ->leftJoin('favorite_tools',
            function($join) use ($userID){
                $join->on('tools.id','=','favorite_tools.id_tool')
                ->where('favorite_tools.id_user',$userID);
            }
        )
        ->join('tool_sub_categories','tool_sub_categories.id_tool','=','tools.id')
        ->where('tools.id',$id)
        ->first();

        $token_max=Subscription::where('id_user',Auth::user()->id)
            ->select(DB::raw('ROUND(SUM(subscriptions.max_word), 3) as max_word'))
            ->first();

        $token_usage = Token_tracker::where('id_user',Auth::user()->id)
            ->select(DB::raw('ROUND(SUM(token_trackers.current_words), 3) as usage_words'),)
            ->first();


        if($pages_sub){

            $feilds = Tools_feild::where('tools_feilds.id_tool',$id)
            ->select('tools_feilds.title','tools_feilds.type')
            ->get();

            $feilds_custom = Tools_feild_custom::where('tools_feild_customs.id_tool',$id)
            ->where('tools_feild_customs.id_user',Auth::user()->id)
            ->get();

            return Inertia::render('auth_pages/AI_tools/ai-template/text_template',[
                'pages'=>$pages_sub,
                'feilds_custom'=>$feilds_custom,
                'feilds'=>$feilds,
                'token_max' => $token_max,
                'token_usage' => $token_usage,
            ]);
        }

        $pages = Tool::select('tools.*','favorite_tools.id_tool','original_categories.name')
        ->leftJoin('favorite_tools',
            function($join) use ($userID){
                $join->on('tools.id','=','favorite_tools.id_tool')
                ->where('favorite_tools.id_user',$userID);
            }
        )
        ->join('tool_original_categories','tool_original_categories.id_tool','=','tools.id')
        ->join('original_categories','original_categories.id','=','tool_original_categories.id_categorie')
        ->where('tools.id',$id)
        ->first();

        $images = Tools_data::select('tools_datas.*')
            ->where('type_data','image')
            ->where('id_user',Auth::user()->id)
            ->get();

        $voices = Tools_data::select('tools_datas.*')
            ->where('type_data','voice')
            ->where('id_user',Auth::user()->id)
            ->get();

        $Image_tokens = Token_tracker::where('token_trackers.id_user',Auth::user()->id)
            ->leftJoin('subscriptions','subscriptions.id_user','=','token_trackers.id_user')
            ->select(
                'token_trackers.id_user',
                DB::raw('ROUND(SUM(current_images), 3) as current_images'),
                DB::raw('ROUND(SUM(subscriptions.max_image), 3) as max_image'),
                )
            ->groupBy('token_trackers.id_user')
            ->get();

        $Voice_tokens = Token_tracker::where('token_trackers.id_user',Auth::user()->id)
            ->leftJoin('subscriptions','subscriptions.id_user','=','token_trackers.id_user')
            ->select(
                'token_trackers.id_user',
                DB::raw('ROUND(SUM(current_minuts), 3) as current_minuts'),
                DB::raw('ROUND(SUM(subscriptions.max_minute), 3) as max_minute'),
                )
            ->groupBy('token_trackers.id_user')
            ->get();

        $name_cat = $pages['name'];

        switch ($name_cat) {
            case 'Image Generator':
                return Inertia::render('auth_pages/AI_tools/ai-template/image_template',[
                    'pages' => $pages,
                    'images' => $images,
                    'Image_tokens' => $Image_tokens,
                ]);
            break;
            case 'Code Generator':
                return Inertia::render('auth_pages/AI_tools/ai-template/code_template',[
                    'pages' => $pages,
                    'token_max' => $token_max,
                    'token_usage' => $token_usage,
                ]);
            break;
            case 'Chat Bot':
                return Redirect::route('tools_Conversation', ['id_tool' => $pages['id']]);
            break;
            case 'Voice Generator':
                return Inertia::render('auth_pages/AI_tools/ai-template/voice_template',[
                    'pages' => $pages,
                    'voices' => $voices,
                    'Voice_tokens' => $Voice_tokens,
                ]);
            break;
        }

    }


    public function generate(Request $request)
    {        
        $secretKey = Apiskey::where('title','Chat GPT 3.5 turbo')->select('key')->first();

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $secretKey['key'],
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => $request->input('messages')
        ]);

        return $response->json();

    }

    public function generateImage(Request $request)
    {     
        $secretKey = Apiskey::where('title','Stable Diffusion')->select('key')->first();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $secretKey['key'],
        ])->asMultipart()->post('https://api.stability.ai/v2beta/stable-image/generate/core', [
            ['name' => 'prompt', 'contents' => $request->input('prompt')],
            ['name' => 'output_format', 'contents' => 'webp'],
        ]);

        if ($response->successful()) {

            $imageName = uniqid('', true) . '.webp';
    
            $imageData = $response->body();

            $imagePath = public_path('/icon/image_generated/' . $imageName);

            $directoryPath = dirname($imagePath);
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0755, true);
            }

            file_put_contents($imagePath, $imageData);

            $webPath = asset('/icon/image_generated/' . $imageName);

            $Tools_data = new Tools_data();
            $Tools_data->id_user = Auth::user()->id;
            $Tools_data->id_tool = $request->input('id_tool');
            $Tools_data->type_data = 'image';
            $Tools_data->image_path = '/icon/image_generated/' . $imageName;
            $Tools_data->title = $request->input('prompt');
    
            $Tools_data->save();

            $wordCount = str_word_count($request->input('prompt'));

            $tokens = $this->countImage($request->input('id_tool'),$wordCount);

            return response()->json(['imagePath' => $webPath , 'imageTitle' => $request->input('prompt') , 'tokencount' => $tokens]);
        } else {
            return response()->json(['error' => 'Failed to generate the image, with response: ' . $response->body()], 500);
        }

        return $response->json();

    }

    public function generateSpeechToText(Request $request)
    {
        $uploadUrl = 'https://api.assemblyai.com/v2/upload';
        $transcribeUrl = 'https://api.assemblyai.com/v2/transcript';
        $apiKey = Apiskey::where('title', 'assembly.ai')->select('key')->first()->key;

        $audioFile = $request->file('audio');
        if (!$audioFile || !$audioFile->isValid()) {
            return response()->json(['error' => 'Invalid file upload'], 400);
        }

        // Upload the audio file to AssemblyAI
        $uploadResponse = Http::withHeaders([
            'authorization' => $apiKey,
        ])->attach(
            'file', fopen($audioFile->getRealPath(), 'r'), $audioFile->getClientOriginalName()
        )->post($uploadUrl);

        if ($uploadResponse->failed()) {
            Log::error('Failed to upload file to AssemblyAI: ' . $uploadResponse->body());
            return response()->json(['error' => 'Failed to upload file to AssemblyAI'], 500);
        }

        $uploadUrl = $uploadResponse->json()['upload_url'];

        // Request transcription of the uploaded audio file
        $transcriptionResponse = Http::withHeaders([
            'authorization' => $apiKey,
            'content-type' => 'application/json',
        ])->post($transcribeUrl, [
            'audio_url' => $uploadUrl,
            'language_detection' => true,
        ]);

        if ($transcriptionResponse->failed()) {
            Log::error('Failed to request transcription from AssemblyAI: ' . $transcriptionResponse->body());
            return response()->json(['error' => 'Failed to request transcription'], 500);
        }

        $transcriptId = $transcriptionResponse->json()['id'];

        // The transcript ID is returned; you can use it to poll for the transcription result
        return response()->json(['transcript_id' => $transcriptId]);
    }
    public function getTranscriptionResult(Request $request)
    {
        $transcribeUrl = 'https://api.assemblyai.com/v2/transcript';
        $apiKey = env('ASSEMBLYAI'); // Replace with your actual Speechmatics API key

        $transcriptId = $request->input('transcript_id');
        if (!$transcriptId) {
            return response()->json(['error' => 'Transcript ID is required'], 400);
        }

        $url = $transcribeUrl . '/' . $transcriptId;
        $response = Http::withHeaders([
            'authorization' => $apiKey,
        ])->get($url);

        if ($response->failed()) {
            Log::error('Failed to retrieve transcription result from AssemblyAI: ' . $response->body());
            return response()->json(['error' => 'Failed to retrieve transcription'], 500);
        }

        $data = $response->json();
        if ($data['status'] !== 'completed') {
            return response()->json(['status' => $data['status']], 202);
        }

        $wordCount = str_word_count($data['text']);

        $tokens = $this->countVoice($request->input('id_tool'),$wordCount);

        return response()->json(['transcription' => $data['text'] , 'tokencount' => $tokens]);

    }


    public function generateTextToSpeech(Request $request)
    {
        
        $voiceId = $request->voice_id;
        $text = $request->text;
        $modelId = $request->model_id;
        $secretKey = Apiskey::where('title', 'elevenlabs.ai')->select('key')->first()->key;

        $curl = curl_init();

        // Append any necessary query parameters to the URL if required.
        $curlUrl = "https://api.elevenlabs.io/v1/text-to-speech/$voiceId";

        curl_setopt_array($curl, [
            CURLOPT_URL => $curlUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                "model_id" => $modelId,
                "text" => $text,
                // Include any additional body parameters as needed, following the API documentation.
            ]),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "xi-api-key: {$secretKey}", // Corrected header for API key
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return response()->json(['error' => "cURL Error: " . $err], 500);
        }

        $character = $request->character;
        $voiceName = uniqid('', true) . '.mp3';
        $filePath = public_path('/icon/voice_generated/' . $voiceName);

        $webPath = asset('/icon/voice_generated/' . $voiceName);

        $wordCount = str_word_count($text);

        $tokens = $this->countVoice($request->input('id_tool'),$wordCount);

        if (!file_exists(dirname($filePath))) {
            mkdir(dirname($filePath), 0755, true);
        }

        file_put_contents($filePath, $response);

        $webPath = asset('icon/voice_generated/' . $voiceName);

        $Tools_data = new Tools_data();
        $Tools_data->id_user = Auth::user()->id;
        $Tools_data->id_tool = $request->input('id_tool');
        $Tools_data->type_data = 'voice';
        $Tools_data->voice_path = '/icon/voice_generated/' . $voiceName;
        $Tools_data->title = $voiceName;
        $Tools_data->language = $request->language;
        $Tools_data->chars = $wordCount;
        $Tools_data->text_content = $text;
        $Tools_data->Gender = $character['Gender'];
        $Tools_data->Description = $character['Description'];
        $Tools_data->VoiceName = $character['VoiceName'];
        

        $Tools_data->save();

        return response()->json(['voicePath' => $webPath  , 'tokencount' => $tokens]);


    }
    

     public function countToken(string $id_tool,string $tokens)
     {
         $token = Token_tracker::where('id_tool',$id_tool)
         ->where('id_user',Auth::user()->id)
         ->first();
 
         if($token){
             $token->current_words += $tokens;
             $token->save();
         }
         else{
             $token = new Token_tracker();
             $token->id_user = Auth::user()->id;
             $token->id_tool = $id_tool;
             $token->current_words = $tokens;
             $token->save();
         }
 
         $tokens = Token_tracker::where('id_user',Auth::user()->id)
         ->select(DB::raw('ROUND(SUM(current_words), 3) as usage_words'))
         ->get();
 
         return response()->json(['success' => true, 'token_usage' => $tokens[0]['usage_words']]);
     }
     
     private function countImage(string $id_tool,string $wordCount)
     {
        $token = Token_tracker::where('id_tool',$id_tool)
        ->where('id_user',Auth::user()->id)
        ->first();

        if($token){
            $token->current_images += $wordCount;
            $token->save();
        }
        else{
            $token = new Token_tracker();
            $token->id_user = Auth::user()->id;
            $token->id_tool = $id_tool;
            $token->current_images = $wordCount;
            $token->save();
        }
 
         $tokens = Token_tracker::where('id_user',Auth::user()->id)
         ->select(DB::raw('ROUND(SUM(current_images), 3) as current_images'))
         ->get();
 
         return $tokens[0]['current_images'];
     }
     private function countVoice(string $id_tool,string $wordCount)
     {
        $token = Token_tracker::where('id_tool',$id_tool)
        ->where('id_user',Auth::user()->id)
        ->first();

        if($token){
            $token->current_minuts += $wordCount;
            $token->save();
        }
        else{
            $token = new Token_tracker();
            $token->id_user = Auth::user()->id;
            $token->id_tool = $id_tool;
            $token->current_minuts = $wordCount;
            $token->save();
        }
 
         $tokens = Token_tracker::where('id_user',Auth::user()->id)
         ->select(DB::raw('ROUND(SUM(current_minuts), 3) as current_minuts'))
         ->get();
 
         return $tokens[0]['current_minuts'];
     }

    public function add_feild(Request $request,string $id)
    {
        $title = $request->get('title');
        $type = $request->get('type');

        $feild = new Tools_feild_custom();

        $feild->id_user=Auth::user()->id;
        $feild->id_tool=$id;
        $feild->title=$title;
        $feild->type=$type;

        $feild->save();

        return Redirect::back()->with('success','add feild successfuly');
    }
    public function edit_feild(Request $request,string $id)
    {
        $title = $request->get('title');
        $type = $request->get('type');

        $feild = Tools_feild_custom::find($id);

        if($feild){
            $feild->title=$title;
            $feild->type=$type;
            $feild->save();
        }

        return Redirect::back()->with('success','edit feild successfuly');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Tools_feild_custom::where('id', $id)
        ->ForceDelete();

        return Redirect::back()->with('success','delete user successfuly');
    }
}
