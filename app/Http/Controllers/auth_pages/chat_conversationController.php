<?php

namespace App\Http\Controllers\auth_pages;

use App\Http\Controllers\Controller;
use App\Models\APIsKey;
use App\Models\Subscription;
use App\Models\Token_tracker;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Models\Tool;
use App\Models\Tools_conversation;
use App\Models\Tools_conversation_data;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Smalot\PdfParser\Parser;

class chat_conversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {  

        $userID = Auth::user()->id;
        $userName = Auth::user()->name;

        $pages = Tool::select('tools.*','favorite_tools.id_tool','tools.title')
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

        $conversations_first =  Tools_conversation::where('id_tool',$id)
        ->where('id_user', $userID)
        ->first();

        if(!$conversations_first && $pages->title == 'Chat Bot'){
            $conversation = new Tools_conversation();

            $conversation->id_user = $userID;
            $conversation->id_tool = $id;
            $conversation->title = 'new conversation';
            $conversation->formatted_created_at = Carbon::parse( date('Y-m-d'));

            $conversation->save();

            $conversation_data = new Tools_conversation_data();

            $conversation_data->id_conversation = $conversation->id;
            $conversation_data->side = 'chatbot';
            $conversation_data->text_content = 'Hello '.$userName.' ! How can I help you today?';

            $conversation_data->save();
        }
        $conversations = Tools_conversation::where('id_tool', $id)
            ->where('id_user', $userID)
            ->LeftJoin('tools_conversation_datas', 'tools_conversation_datas.id_conversation', '=', 'tools_conversations.id')
            ->groupBy('tools_conversations.id')
            ->select(
                'tools_conversations.*',
                DB::raw('COALESCE(COUNT(tools_conversation_datas.id), 0) as tools_conversation_count')
            )
            ->orderBy('created_at','desc')
            ->get();

        $conversations_first =  Tools_conversation::where('id_tool',$id)
            ->where('id_user', $userID)
            ->first();
        
        $conversation_data = [];
        $pdfcontent = null;
        if($conversations_first){
            $conversation_data = Tools_conversation_data::select('Tools_conversation_datas.*','tools_conversations.doc_path')
            ->join('tools_conversations','tools_conversations.id','=','Tools_conversation_datas.id_conversation')
            ->where('id_conversation',$conversations_first['id'])
            ->get();
            $first_conversation_data = $conversation_data->first();
            
            if ($first_conversation_data) {
                $pdfcontent = $this->extractText($first_conversation_data->doc_path);
            }
        }

        $token_max=Subscription::where('id_user',Auth::user()->id)
            ->select(DB::raw('ROUND(SUM(subscriptions.max_word), 3) as max_word'))
            ->first();

        $token_usage = Token_tracker::where('id_user',Auth::user()->id)
            ->select(DB::raw('ROUND(SUM(token_trackers.current_words), 3) as usage_words'),)
            ->first();


        $name_cat = $pages['title'];

        switch ($name_cat) {
            case 'Chat Bot':
                return Inertia::render('auth_pages/AI_tools/ai-template/chat_template/chatBot',[
                    'pages' => $pages,
                    'current_conversation' => $conversations_first,
                    'conversations_list'=>$conversations,
                    'conversation_data'=>$conversation_data,
                    'token_max' => $token_max,
                    'token_usage' => $token_usage,
                ]);
            break;
            case 'document Chat':
                return Inertia::render('auth_pages/AI_tools/ai-template/chat_template/document_chat',[
                    'pages' => $pages,
                    'pdfcontent' => $pdfcontent,
                    'current_conversation' => $conversations_first,
                    'conversations_list'=>$conversations,
                    'conversation_data'=>$conversation_data,
                    'token_max' => $token_max,
                    'token_usage' => $token_usage,
                ]);
            break;
        }

    }

    public function nextPage(string $id,string $id_conversation)
    {  

        $userID = Auth::user()->id;
        $userName = Auth::user()->name;

        $pages = Tool::select('tools.*','favorite_tools.id_tool','tools.title')
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

        $conversations_first = Tools_conversation_data::where('id_conversation',$id_conversation)->first();

        if(!$conversations_first){

            $conversation_data = new Tools_conversation_data();

            $conversation_data->id_conversation = $id_conversation;
            $conversation_data->side = 'chatbot';
            $conversation_data->text_content = 'Hello '.$userName.' ! How can I help you today?';

            $conversation_data->save();
        }
        $conversations = Tools_conversation::where('id_tool', $id)
            ->where('id_user', $userID)
            ->LeftJoin('tools_conversation_datas', 'tools_conversation_datas.id_conversation', '=', 'tools_conversations.id')
            ->groupBy('tools_conversations.id')
            ->select(
                'tools_conversations.*',
                DB::raw('COALESCE(COUNT(tools_conversation_datas.id), 0) as tools_conversation_count')
            )
            ->orderBy('created_at','desc')
            ->get();

        $conversations_first =  Tools_conversation::find($id_conversation);

        $conversation_data = [];
        $pdfcontent = null;
        if($conversations_first){
            $conversation_data = Tools_conversation_data::select('Tools_conversation_datas.*','tools_conversations.doc_path')
            ->join('tools_conversations','tools_conversations.id','=','Tools_conversation_datas.id_conversation')
            ->where('id_conversation',$conversations_first['id'])
            ->get();

            $first_conversation_data = $conversation_data->first();

            if ($first_conversation_data) {
                $pdfcontent = $this->extractText($first_conversation_data->doc_path);
            }
        }

        $token_max=Subscription::where('id_user',Auth::user()->id)
        ->select(DB::raw('ROUND(SUM(subscriptions.max_word), 3) as max_word'))
        ->first();

        $token_usage = Token_tracker::where('id_user',Auth::user()->id)
            ->select(DB::raw('ROUND(SUM(token_trackers.current_words), 3) as usage_words'),)
            ->first();

        $name_cat = $pages['title'];

        switch ($name_cat) {
            case 'Chat Bot':
                return Inertia::render('auth_pages/AI_tools/ai-template/chat_template/chatBot',[
                    'pages' => $pages,
                    'current_conversation' => $conversations_first,
                    'conversations_list'=>$conversations,
                    'conversation_data'=>$conversation_data,
                    'token_max' => $token_max,
                    'token_usage' => $token_usage,
                ]);
            break;
            case 'document Chat':
                return Inertia::render('auth_pages/AI_tools/ai-template/chat_template/document_chat',[
                    'pages' => $pages,
                    'pdfcontent' => $pdfcontent,
                    'current_conversation' => $conversations_first,
                    'conversations_list'=>$conversations,
                    'conversation_data'=>$conversation_data,
                    'token_max' => $token_max,
                    'token_usage' => $token_usage,
                ]);
            break;
        }

    }

    private function extractText($filepath)
    {
        $parser = new Parser();

        $pdfPath = public_path($filepath);

        try {
            $pdf = $parser->parseFile($pdfPath);
            $text = $pdf->getText();
            return response()->json(['text' => $text]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'File not found or unable to extract text.'], 404);
        }
    }
    public function generate(Request $request, string $id_tool, string $id_conversation)
    {
        // Save the user's message
        $messages_user = $request->get('messages_user');
    
        $user_conversation_data = new Tools_conversation_data();
        $user_conversation_data->id_conversation = $id_conversation;
        $user_conversation_data->side = 'user';
        $user_conversation_data->text_content = $messages_user;
        $user_conversation_data->save();
    
        $secretKey = Apiskey::where('title','Chat GPT 3.5 turbo')->select('key')->first();
        // Send the request to OpenAI and get the response
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $secretKey['key'],
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => $request->input('messages')
        ]);
    
        // Assuming the response structure is correct, save the assistant's message
        $assistant_message_content = $response['choices'][0]['message']['content']; // Adjust based on actual response structure
    
        $assistant_conversation_data = new Tools_conversation_data();
        $assistant_conversation_data->id_conversation = $id_conversation;
        $assistant_conversation_data->side = 'assistant'; // Correctly set side for assistant
        $assistant_conversation_data->text_content = $assistant_message_content;
        $assistant_conversation_data->save();
        
        return $response->json();
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,string $id_tool)
    {

        $title = $request->get('title');
        $file_path = $request->file('file_path');

        $Tools_conversation = new Tools_conversation();
        $Tools_conversation->id_user = Auth::user()->id;
        $Tools_conversation->id_tool = $id_tool;
        $Tools_conversation->title = $title;

        if($file_path){
            $newPath = public_path('icon/docs_chat/');

            $filename_bg = uniqid() . '_' . time() . '.' . $file_path->getClientOriginalExtension();
            $file_path->move($newPath, $filename_bg);

            $filePath = 'icon/docs_chat/' . $filename_bg;
            $Tools_conversation->doc_path = $filePath;
            $Tools_conversation->doc_name = $filename_bg;
        }

        $Tools_conversation->formatted_created_at = Carbon::parse( date('Y-m-d'));
        $Tools_conversation->save();
        
        return Redirect::back()->with('success','Add Conversation Successfuly');
    }


    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,string $id)
    {
        $title = $request->get('title');

        $Tools_conversation = Tools_conversation::find($id);

        $Tools_conversation->title = $title;
        $Tools_conversation->formatted_created_at = Carbon::parse( date('Y-m-d'));

        $Tools_conversation->save();
        
        return Redirect::back()->with('success','edit Conversation Successfuly');
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
    public function destroy(string $id,string $id_tool)
    {
        $Tools_conversation = Tools_conversation::find($id);

        $relativePath = ltrim($Tools_conversation['doc_path'], '/');

        $imagePath = public_path($relativePath);

        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $Tools_conversation->forceDelete();

        if($id_tool == 'refresh')
            return Redirect::back()->with('success','delete Conversation Successfuly');

        return Redirect::route('tools_Conversation', ['id_tool' => $id_tool]);
    }
}
