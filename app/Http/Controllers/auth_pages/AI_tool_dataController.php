<?php

namespace App\Http\Controllers\auth_pages;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Tools_data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class AI_tool_dataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function document_data()
    {  
        $Documents = Tools_data::where('id_user',Auth::user()->id)
            ->where('type_data','text')
            ->join('tools','tools.id','=','tools_datas.id_tool')
            ->select('tools_datas.*','tools.title as Tool',DB::raw('DATE(tools_datas.created_at) as date'))
            ->get();

        return Inertia::render('auth_pages/documents/document_data',[
            'Documents' => $Documents
        ]);
    }

    public function document_edit(string $id_doc)
    {  
        $Documents = Tools_data::where('id_user',Auth::user()->id)
            ->where('id',$id_doc)
            ->select('tools_datas.*',DB::raw('DATE(created_at) as date'))
            ->get();

        return Inertia::render('auth_pages/documents/show_data/doc',[
            'Documents' => $Documents
        ]);
    }

    public function image_data()
    {  
        
        $images = Tools_data::select('tools_datas.*',DB::raw('DATE(created_at) as date'))
            ->where('type_data','image')
            ->where('id_user',Auth::user()->id)
            ->get();

        return Inertia::render('auth_pages/documents/image_data',[
            'images' => $images
        ]);
    }
    
    public function code_data()
    {  
        $Documents = Tools_data::where('id_user',Auth::user()->id)
            ->where('type_data','code')
            ->join('tools','tools.id','=','tools_datas.id_tool')
            ->select('tools_datas.*','tools.title as Tool',DB::raw('DATE(tools_datas.created_at) as date'))
            ->get();

        return Inertia::render('auth_pages/documents/code_data',[
            'Documents' => $Documents
        ]);
    }

    public function code_edit(string $id_code)
    {  
        $Documents = Tools_data::where('id_user',Auth::user()->id)
            ->where('id',$id_code)
            ->select('tools_datas.*')
            ->get();

        return Inertia::render('auth_pages/documents/show_data/code',[
            'Documents' => $Documents
        ]);
    }
    public function voice_data()
    {  
        $voices = Tools_data::select('tools_datas.*',DB::raw('DATE(created_at) as date'))
            ->where('type_data','voice')
            ->where('id_user',Auth::user()->id)
            ->get();

        return Inertia::render('auth_pages/documents/voice_data',[
            'voices' => $voices
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function textsave(Request $request,string $id_tool)
    {
        $title = $request->get('title');
        $content = $request->get('content');
        $language = $request->get('language');
        $htmlContent = $request->get('htmlContent');

        $Tools_data = new Tools_data();
        $Tools_data->id_user = Auth::user()->id;
        $Tools_data->id_tool = $id_tool;
        $Tools_data->type_data = 'text';
        $Tools_data->language = $language;
        $Tools_data->htmlContent = $htmlContent;
        $Tools_data->text_content = $content;
        $Tools_data->title = $title;

        $Tools_data->save();
        
        return Redirect::back()->with('success','Save Successfuly');
    }
    public function textedit(Request $request,string $id)
    {
        $title = $request->get('title');
        $htmlContent = $request->get('htmlContent');

        $Tools_data = Tools_data::find($id);

        $Tools_data->htmlContent = $htmlContent;
        $Tools_data->title = $title;

        $Tools_data->save();
        
        return Redirect::back()->with('success','Save Successfuly');
    }

    public function codesave(Request $request,string $id_tool)
    {
        $title = $request->get('title');
        $htmlContent = $request->get('htmlContent');
        $language = $request->get('language');
        $content = $request->get('content');

        $Tools_data = new Tools_data();
        $Tools_data->id_user = Auth::user()->id;
        $Tools_data->id_tool = $id_tool;
        $Tools_data->type_data = 'code';
        $Tools_data->text_content = $content;
        $Tools_data->htmlContent = $htmlContent;
        $Tools_data->language = $language;
        $Tools_data->title = $title;

        $Tools_data->save();
        
        return Redirect::back()->with('success','Save Successfuly');
    }
    public function codeedit(Request $request,string $id)
    {
        $title = $request->get('title');

        $Tools_data = Tools_data::find($id);

        $Tools_data->title = $title;

        $Tools_data->save();
        
        return Redirect::back()->with('success','Save Successfuly');
    }

    public function imagesave(Request $request,string $id_tool)
    {
        $title = $request->get('title');
        $content = $request->get('content');

        $Tools_data = new Tools_data();
        $Tools_data->id_user = Auth::user()->id;
        $Tools_data->id_tool = $id_tool;
        $Tools_data->type_data = 'image';
        $Tools_data->text_content = $content;
        $Tools_data->title = $title;

        $Tools_data->save();
        
        return Redirect::back()->with('success','Save Successfuly');
    }

    public function voicesave(Request $request,string $id_tool)
    {
        $title = $request->get('title');
        $content = $request->get('content');

        $Tools_data = new Tools_data();
        $Tools_data->id_user = Auth::user()->id;
        $Tools_data->id_tool = $id_tool;
        $Tools_data->type_data = 'voice';
        $Tools_data->text_content = $content;
        $Tools_data->title = $title;

        $Tools_data->save();
        
        return Redirect::back()->with('success','Save Successfuly');
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
        $Tools_data = Tools_data::where('id',$id)
        ->where('id_user',Auth::user()->id)
        ->first();

        $relativePath = ltrim($Tools_data['image_path'], '/');

        $imagePath = public_path($relativePath);

        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $Tools_data->forceDelete();

        return Redirect::back()->with('success','delete image Successfuly');
    }

    public function destroyVoice(string $id)
    {
        $Tools_data = Tools_data::where('id',$id)
        ->where('id_user',Auth::user()->id)
        ->first();

        $relativePath = ltrim($Tools_data['voice_path'], '/');

        $imagePath = public_path($relativePath);

        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $Tools_data->forceDelete();

        return Redirect::back()->with('success','delete voice Successfuly');
    }
}
