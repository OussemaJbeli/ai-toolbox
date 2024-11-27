<?php

namespace App\Http\Controllers\admin_pages;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class user_manegement_adminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $users = User::where('super_user', false)
        ->where('admin', false)
        ->get();

        $super_user = User::where('super_user', true)
        ->where('admin', false)
        ->get();

        return Inertia::render('admin_pages/users_management/index',[
            'users' => $users,
            'super_user' => $super_user,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function add_special_user(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => 'required', 'confirmed',
        ]);
    
        $user = new User();
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->payment = true;
        $user->avatar = 'icon/sid_bar/avatar/avatar1.png';
        $user->sid_img = 'icon/sid_bar/wallpapers/img_1.jpg';
        $user->filter = '#ffc502';
        $user->darkMode = true;
        $user->email_verified_at = now();
        $user->special_user = true;
    
        $user->save();

        return Redirect::back()->with('success','add user successfuly');
    }
    public function add_admin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => 'required', 'confirmed',
        ]);
    
        $user = new User();
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->payment = true;
        $user->avatar = 'icon/sid_bar/avatar/avatar1.png';
        $user->sid_img = 'icon/sid_bar/wallpapers/img_1.jpg';
        $user->filter = '#ffc502';
        $user->darkMode = true;
        $user->email_verified_at = now();
        $user->special_user = true;
        $user->super_user = true;
    
        $user->save();

        return Redirect::back()->with('success','add user successfuly');
    }
    public function edit_user(Request $request,string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return Redirect::back()->with('success','add user successfuly');
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

    public function addsubscribe(string $id)
    {
        $userTrak = User::where('id',$id)->first();
        $userTrak->payment = true;
        $userTrak->special_user = true;
        $userTrak->save();

        return Redirect::back()->with('success','add subscription successfuly');
    }

    public function dessubscribe(string $id)
    {
        $Subscription = Subscription::where('id_user',$id)->first();
        if($Subscription)
            $Subscription->forceDelete();

        $userTrak = User::where('id',$id)->first();
        $userTrak->payment = false;
        $userTrak->special_user = false;
        $userTrak->save();

        return Redirect::back()->with('success','remove subscription successfuly');
    }
    public function destroy(string $id)
    {
        User::where('id', $id)
        ->delete();

        return Redirect::back()->with('success','delete user successfuly');
    }
}
