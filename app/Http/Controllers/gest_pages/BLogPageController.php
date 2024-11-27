<?php

namespace App\Http\Controllers\gest_pages;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BLogPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {  
        $blogs = Blog::join('users','users.id','=','blogs.id_user')
            ->select( 
                'blogs.*',
                'users.name',
            )
            ->where('blogs.id',$id)
            ->first();

        return view('blog',['blog' => $blogs]);
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
