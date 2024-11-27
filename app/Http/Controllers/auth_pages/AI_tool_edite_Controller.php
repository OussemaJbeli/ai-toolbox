<?php

namespace App\Http\Controllers\auth_pages;

use App\Http\Controllers\Controller;
use App\Models\Custom_categorie;
use App\Models\Favorite_original_categorie;
use App\Models\Favorite_sub_categorie;
use App\Models\Tool;
use App\Models\Tool_custom_categorie;
use App\Models\Tool_original_categorie;
use App\Models\Tool_sub_categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use DateTime;

class AI_tool_edit_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  

            $favorit_categories_custom = Custom_categorie::where('id_user', Auth::user()->id)
            ->get();

            $toolsNumsCustom = Tool_custom_categorie::groupBy('tool_custom_categories.id_categorie')
            ->join('tools', 'tools.id', '=', 'tool_custom_categories.id_tool')
            ->select(
                'tool_custom_categories.id_categorie',
                DB::raw('COALESCE(count(tools.id), 0) as count_tool'))
            ->get();

            foreach ($favorit_categories_custom as $categorie) {
                $categorie->count_tools = 0;
                foreach ($toolsNumsCustom as $tool) {
                    if($categorie->id === $tool->id_categorie)
                        $categorie->count_tools = $tool->count_tool;
                }
            }

            $favorit_categories_original = Favorite_original_categorie::select('original_categories.*')
            ->join('original_categories','original_categories.id','=','favorite_original_categories.id_categorie')
            ->where('id_user',Auth::user()->id)
            ->get();

            $toolsNumsCustom = Tool_original_categorie::groupBy('tool_original_categories.id_categorie')
            ->join('tools', 'tools.id', '=', 'tool_original_categories.id_tool')
            ->select(
                'tool_original_categories.id_categorie',
                DB::raw('COALESCE(count(tools.id), 0) as count_tool'))
            ->get();

            foreach ($favorit_categories_original as $categorie) {
                $categorie->count_tools = 0;
                foreach ($toolsNumsCustom as $tool) {
                    if($categorie->id === $tool->id_categorie)
                        $categorie->count_tools = $tool->count_tool;
                }
            }

            $favorit_sub_categorie= Favorite_sub_categorie::select('sub_categories.*')
            ->join('sub_categories','sub_categories.id','=','favorite_sub_categories.id_categorie')
            ->where('id_user',Auth::user()->id)
            ->get();

            $toolsNumsCustom = Tool_sub_categorie::groupBy('tool_sub_categories.id_categorie')
            ->join('tools', 'tools.id', '=', 'tool_sub_categories.id_tool')
            ->select(
                'tool_sub_categories.id_categorie',
                DB::raw('COALESCE(count(tools.id), 0) as count_tool'))
            ->get();

            foreach ($favorit_sub_categorie as $categorie) {
                $categorie->count_tools = 0;
                foreach ($toolsNumsCustom as $tool) {
                    if($categorie->id === $tool->id_categorie)
                        $categorie->count_tools = $tool->count_tool;
                }
            }
        return Inertia::render('auth_pages/edit_tools/index',[
            'favorit_categories_custom' => $favorit_categories_custom,
            'favorit_categories_original' => $favorit_categories_original,
            'favorit_sub_categorie' => $favorit_sub_categorie,
        ]);
    }

    public function edit(string $id)
    {
        $categorie = Custom_categorie::find($id);

        $list_tools = Tool_custom_categorie::select('tools.*')
            ->join('tools', 'tools.id', '=', 'tool_custom_categories.id_tool')
            ->where('tool_custom_categories.id_categorie',$id)
            ->get();

        $tools = Tool::all();

        foreach ($tools as $tool) {
            $tool->have_token = false;
            foreach ($list_tools as $list_tool) {
                if($tool->id == $list_tool->id)
                $tool->have_token = true;
            }
        }

        return Inertia::render('auth_pages/edit_tools/edit_tools',[
            'categorie' => $categorie,
            'list_tools' => $list_tools,
            'tools' => $tools
        ]);
    }

    public function update(Request $request, string $id)
    {
        $name = $request->get('name');
        $description = $request->get('description');

        $Tools_categorie = Custom_categorie::find($id);

        if($Tools_categorie){

            $Tools_categorie->id_user = Auth::user()->id;
            $Tools_categorie->name = $name;
            $Tools_categorie->description = $description;
    
            $Tools_categorie->save();

            return Redirect::back()
            ->with('success', 'Change Saved');
        }

        return Redirect::back();
    }

    public function add_favorit(string $id_tool,string $id_categorie)
    {
        $tool = Tool_custom_categorie::where('id_tool', $id_tool)
        ->where('id_categorie', $id_categorie)
        ->first();

        if($tool){
            $tool->forceDelete();
            return Redirect::back();
        }
        $tool = new Tool_custom_categorie();
        $tool->id_categorie = $id_categorie;
        $tool->id_tool = $id_tool;
        $tool->save();

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
