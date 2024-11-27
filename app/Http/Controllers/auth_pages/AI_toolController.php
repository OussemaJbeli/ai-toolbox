<?php

namespace App\Http\Controllers\auth_pages;

use App\Http\Controllers\Controller;
use App\Models\Favorite_sub_tool;
use App\Models\Favorite_tool;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use DateTime;
use Illuminate\Support\Facades\Redirect;

class AI_toolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        return Inertia::render('auth_pages/AI_tools/index');
    }
    public function edit_tools()
    {  
        return Inertia::render('auth_pages/AI_tools/edit_tools');
    }
    public function aiindex1()
    {  
        return Inertia::render('auth_pages/AI_tools/index');
    }
    public function aiindex2()
    {  
        return Inertia::render('auth_pages/AI_tools/index');
    }
    public function aiindex3()
    {  
        return Inertia::render('auth_pages/AI_tools/index');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    public function add_favorit(string $id_tool)
    {
        $tool = Favorite_tool::where('id_tool', $id_tool)
        ->where('id_user', Auth::user()->id)
        ->first();

        if($tool){
            $tool->forceDelete();
            return Redirect::back()
            ->with(['favorit_title'=>'Tool Removed from Favorites','favorit_description'=>'Selected Tool has been successfully removed from favorites']);
        }
        $tool = new Favorite_tool();
        $tool->id_user = Auth::user()->id;
        $tool->id_tool = $id_tool;
        $tool->save();

        return Redirect::back()
        ->with(['favorit_title'=>'Tool Added to Favorites','favorit_description'=>'Selected Tool has been successfully added to favorites']);
    }

    /**
     * Display the specified resource.
     */
    public function remove_from_favorit(string $id)
    {
        $favorit = Favorite_tool::where('id_tool', $id)
        ->where('id_user', Auth::user()->id)
        ->first();

        if($favorit){
            $favorit->forceDelete();
            return Redirect::back()
            ->with('success','Tool removed');
        }
        return Redirect::back();
    }

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
        //
    }
}
