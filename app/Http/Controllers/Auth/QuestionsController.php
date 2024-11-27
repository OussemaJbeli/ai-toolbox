<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Favorite_sub_categorie;
use App\Models\Favorite_tool;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        return Inertia::render('gest_pages/Auth/questions');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $question = $request->get('question3');

        //tools
        $dev_tools=[70,73];
        $analyse_tools=[70,73,72];
        $solve_tools=[70,73,72];
        $designer_tools=[73,69,71];
        $marketing_tools=[73,34,35,36,37,38];

        //article
        $content_categorie=[1,6,8];
        $buisbes_categorie=[2,3,5];


        switch ($question) {

            case 'software developement':
                foreach ($dev_tools as $tool) {
                    $cagegorie = new Favorite_tool();
                    $cagegorie->id_user = Auth::user()->id;
                    $cagegorie->id_tool = $tool;
                    $cagegorie->save();
                }
            break;
            case 'Analyze Data':
                foreach ($analyse_tools as $tool) {
                    $cagegorie = new Favorite_tool();
                    $cagegorie->id_user = Auth::user()->id;
                    $cagegorie->id_tool = $tool;
                    $cagegorie->save();
                }
            break;
            case 'Create Content':
                foreach ($content_categorie as $categorie) {
                    $cagegorie = new Favorite_sub_categorie();
                    $cagegorie->id_user = Auth::user()->id;
                    $cagegorie->id_categorie = $categorie;
                    $cagegorie->save();
                }
            break;
            case 'Solve Complex Problems':
                foreach ($solve_tools as $tool) {
                    $cagegorie = new Favorite_tool();
                    $cagegorie->id_user = Auth::user()->id;
                    $cagegorie->id_tool = $tool;
                    $cagegorie->save();
                }
            break;
            case 'Business Optimization Stay Ahead':
                foreach ($buisbes_categorie as $categorie) {
                    $cagegorie = new Favorite_sub_categorie();
                    $cagegorie->id_user = Auth::user()->id;
                    $cagegorie->id_categorie = $categorie;
                    $cagegorie->save();
                }
            break;
            case 'Graphic Designer':
                foreach ($designer_tools as $tool) {
                    $cagegorie = new Favorite_tool();
                    $cagegorie->id_user = Auth::user()->id;
                    $cagegorie->id_tool = $tool;
                    $cagegorie->save();
                }
            break;
            case 'Marketer and Sale Professional':
                foreach ($marketing_tools as $tool) {
                    $cagegorie = new Favorite_tool();
                    $cagegorie->id_user = Auth::user()->id;
                    $cagegorie->id_tool = $tool;
                    $cagegorie->save();
                }
            break;
            
        }
        $user = User::find(Auth::user()->id);

        $user->answered = true;
        $user->save();

        return Redirect::route('dashboard');
    }

    public function skip()
    {
        $user = User::find(Auth::user()->id);

        $user->answered = true;
        $user->save();

        return Redirect::route('dashboard');
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
        //
    }
}
