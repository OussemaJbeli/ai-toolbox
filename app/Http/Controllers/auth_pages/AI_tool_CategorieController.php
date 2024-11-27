<?php

namespace App\Http\Controllers\auth_pages;

use App\Http\Controllers\Controller;
use App\Models\Custom_categorie;
use App\Models\Favorite_original_categorie;
use App\Models\Favorite_sub_categorie;
use App\Models\Original_categorie;
use App\Models\Sub_categorie;
use App\Models\tool_custom_categorie;
use App\Models\Tool_original_categorie;
use App\Models\Tool_sub_categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AI_tool_CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        // return Inertia::render('auth_pages/AI_tools/index');
    }

    public function ai_categories_list()
    {  
        return Inertia::render('auth_pages/AI_categories/index');
    }

    public function add_favorit(string $id_categorie)
    {
        $cagegorie = Favorite_original_categorie::where('id_categorie', $id_categorie)
        ->where('id_user', Auth::user()->id)
        ->first();

        if($cagegorie){
            $cagegorie->forceDelete();
            return Redirect::back()
            ->with(['favorit_title'=>'Categorie Removed from Favorites','favorit_description'=>'Selected categorie has been successfully removed from favorites']);
        }
        
        $cagegorie = new Favorite_original_categorie();
        $cagegorie->id_user = Auth::user()->id;
        $cagegorie->id_categorie = $id_categorie;
        $cagegorie->save();

        return Redirect::back()
        ->with(['favorit_title'=>'Categorie Added to Favorites','favorit_description'=>'Selected categorie has been successfully added to favorites']);
    }

    public function add_sub_favorit(string $id_categorie)
    {
        $cagegorie = Favorite_sub_categorie::where('id_categorie', $id_categorie)
        ->where('id_user', Auth::user()->id)
        ->first();

        if($cagegorie){
            $cagegorie->forceDelete();
            return Redirect::back()
            ->with(['favorit_title'=>'Categorie Removed from Favorites','favorit_description'=>'Selected categorie has been successfully removed from favorites']);
        }
        $cagegorie = new Favorite_sub_categorie();
        $cagegorie->id_user = Auth::user()->id;
        $cagegorie->id_categorie = $id_categorie;
        $cagegorie->save();

        return Redirect::back()
        ->with(['favorit_title'=>'Categorie Added to Favorites','favorit_description'=>'Selected categorie has been successfully added to favorites']);
    }

    public function store(Request $request)
    {
        $name = $request->get('name');
        $description = $request->get('description');

        $Tools_categorie = new Custom_categorie();

        $Tools_categorie->name = $name;
        $Tools_categorie->description = $description;
        $Tools_categorie->id_user = Auth::user()->id;

        $Tools_categorie->save();

        return Redirect::back()
        ->with('success', 'Categorie Saved');
    }

    public function remove_from_favorit(string $id_categorie)
    {
        $cagegorie = Favorite_original_categorie::where('id_categorie', $id_categorie)
        ->where('id_user', Auth::user()->id)
        ->first();

        if($cagegorie){
            $cagegorie->forceDelete();
            return Redirect::back()
            ->with('success','Categorie removed');
        }

        return Redirect::back();
    
    }

    public function remove_from_sub_favorit(string $id_categorie)
    {
        $cagegorie = Favorite_sub_categorie::where('id_categorie', $id_categorie)
        ->where('id_user', Auth::user()->id)
        ->first();

        if($cagegorie){
            $cagegorie->forceDelete();
            return Redirect::back()
            ->with('success','Categorie removed');
        }

        return Redirect::back();
       
    }

    public function remove_from_custom_favorit(string $id_categorie)
    {
        $cagegorie = Custom_categorie::where('id', $id_categorie)
        ->where('id_user', Auth::user()->id)
        ->first();

        if($cagegorie){
            $cagegorie->forceDelete();
            return Redirect::back()
            ->with('success','Categorie removed');
        }

        return Redirect::back()->with('success',$cagegorie);
    }
    public function show(string $id,string $type)
    {
        switch ($type) {
            case 'custom':
                $categorie = Custom_categorie::find($id);

                $list_tools = tool_custom_categorie::select('tools.*')
                    ->join('tools', 'tools.id', '=', 'tool_custom_categories.id_tool')
                    ->where('tool_custom_categories.id_categorie',$id)
                    ->get();
            break;
            case 'sub':
                $categorie = Sub_categorie::find($id);

                $list_tools = Tool_sub_categorie::select('tools.*')
                    ->join('tools', 'tools.id', '=', 'tool_sub_categories.id_tool')
                    ->where('tool_sub_categories.id_categorie',$id)
                    ->get();
            break;
            case 'original':
                $categorie = Original_categorie::find($id);

                $list_tools = Tool_original_categorie::select('tools.*')
                    ->join('tools', 'tools.id', '=', 'tool_original_categories.id_tool')
                    ->where('tool_original_categories.id_categorie',$id)
                    ->get();
            break;
        }

        return Inertia::render('auth_pages/AI_categories/show_tools_cat',[
            'categorie' => $categorie,
            'list_tools' => $list_tools,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
