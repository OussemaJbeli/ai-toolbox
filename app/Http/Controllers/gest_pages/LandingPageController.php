<?php

namespace App\Http\Controllers\gest_pages;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Plan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Target_limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use DateTime;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $plan = Plan::all();
        $blogs = Blog::join('users','users.id','=','blogs.id_user')
            ->select( 
                'blogs.*',
                'users.name',
            )
            ->get();

        return view('LandingPage',[
            'plan' => $plan,
            'blogs' => $blogs
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
