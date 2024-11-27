<?php

namespace App\Http\Controllers\admin_pages;

use App\Http\Controllers\Controller;
use App\Models\Apiskey;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class general_setting_adminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function chatGPT()
    {  
        $api_info = Apiskey::where('title','Chat GPT 3.5 turbo')->first();

        return Inertia::render('admin_pages/settings/chatGPT',[
            'api_info' => $api_info,
        ]);
    }

    public function  StableDiffusion()
    {  
        $api_info = Apiskey::where('title','Stable Diffusion')->first();

        return Inertia::render('admin_pages/settings/StableDiffusion',[
            'api_info' => $api_info,
        ]);
    }

    public function  TTS()
    {  
        $api_info = Apiskey::where('title','elevenlabs.ai')->first();

        return Inertia::render('admin_pages/settings/TTS',[
            'api_info' => $api_info,
        ]);
    }

    public function  STT()
    {  
        $api_info = Apiskey::where('title','assembly.ai')->first();

        return Inertia::render('admin_pages/settings/STT',[
            'api_info' => $api_info,
        ]);
    }

    public function  stripe_secret_key()
    {  
        $api_info = Apiskey::where('title','stripe secret key')
            ->first();

        return Inertia::render('admin_pages/settings/stripe_secret_key',[
            'api_info' => $api_info,
        ]);
    }

    public function  stripe_public_key()
    {  
        $api_info = Apiskey::where('title','stripe public key')
            ->first();

        return Inertia::render('admin_pages/settings/stripe_public_key',[
            'api_info' => $api_info,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function storeAPI(Request $request)
    {

        $title = $request->get('title');
        $key = $request->get('key');

        $keydb = Apiskey::where('title',$title)->first();
        
        $keydb->key = $key;

        $keydb->save();

        return Redirect::back()->with('success','key saved successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        //
    }
}
