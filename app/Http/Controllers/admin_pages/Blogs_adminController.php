<?php

namespace App\Http\Controllers\admin_pages;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use DateTime;
use Illuminate\Support\Facades\Redirect;

class Blogs_adminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $blogs = Blog::join('users','users.id','=','blogs.id_user')
            ->select( 
                'blogs.*',
                'users.name',
                DB::raw('DATE(blogs.created_at) as date'))
            ->get();

        return Inertia::render('admin_pages/blog/index',[
            'blogs' => $blogs,
        ]);
    }

    public function show_to_create()
    {  
        return Inertia::render('admin_pages/blog/create_blog');
    }

    public function show_to_edit(string $id)
    {  
        $blogs = Blog::where('id',$id)
            ->select( 
                'blogs.*',
                DB::raw('DATE(blogs.created_at) as date'))
            ->first();

        return Inertia::render('admin_pages/blog/edite_blog',[
            'blog' => $blogs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $title = $request->get('title');
        $content = $request->get('htmlContent');
        $image_path = $request->file('image_path');

        $imagePath = public_path('/icon/blog_image/');

        $directoryPath = dirname($imagePath);
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }

        $filename_bg = uniqid() . '_' . time() . '.' . $image_path->getClientOriginalExtension();
        $image_path->move($imagePath, $filename_bg);
        $blog = new Blog();
        $blog->id_user = Auth::user()->id;
        $blog->title = $title;
        $blog->continue = $content;
        $blog->image_path = '/icon/blog_image/'.$filename_bg;

        $blog->save();
        
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
    /**
     * Update the specified resource in storage.
     */
    public function edit(Request $request, string $id)
    {
        $title = $request->get('title');
        $content = $request->get('htmlContent');
        $image_path = $request->file('image_path');

        $blog = Blog::find($id);

        if($blog){
            
            $blog->id_user = Auth::user()->id;
            $blog->title = $title;
            $blog->continue = $content;

            if($image_path)
            {
                $relativePath = ltrim($blog['image_path'], '/');

                $imagePath = public_path($relativePath);
        
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
                
                $imagePath = public_path('/icon/blog_image/');
                $filename_bg = uniqid() . '_' . time() . '.' . $image_path->getClientOriginalExtension();
                $image_path->move($imagePath, $filename_bg);

                $blog->image_path = '/icon/blog_image/'.$filename_bg;
            }
    
            $blog->save();
            
            return Redirect::back()->with('success','Save Successfuly');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $Blog = Blog::where('id', $id)->first();

        $relativePath = ltrim($Blog['image_path'], '/');

        $imagePath = public_path($relativePath);

        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        Blog::where('id', $id)
        ->forceDelete();

        return Redirect::back()->with('success','delete Blog successfuly');
    }
}
