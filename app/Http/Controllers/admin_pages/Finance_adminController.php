<?php

namespace App\Http\Controllers\admin_pages;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Token_tracker;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class Finance_adminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $plans = Plan::all();

        return Inertia::render('admin_pages/Finance/plan',[
            'plans' => $plans,
        ]);
    }

    public function subscribers()
    {          
        $subscriber = Subscription::join('users','users.id','=','subscriptions.id_user')
        ->join('plans','plans.id','=','subscriptions.id_plan')
        ->groupBy('users.id',)
        ->select('users.*',
                DB::raw('ROUND(SUM(plans.words), 3) as words'),
                DB::raw('ROUND(SUM(plans.image), 3) as image'),
                DB::raw('ROUND(SUM(plans.minute), 3) as minute'),
                )
        ->get();

        $tokens = Token_tracker::all();
        foreach ($subscriber as $user) {
            $user->usage_word = 0;
            $user->usage_image = 0;
            $user->usage_minute = 0;

            foreach ($tokens as $token) {
                if($user->id == $token->id_user){
                    $user->usage_word += $token->current_words;
                    $user->usage_image += $token->current_images;
                    $user->usage_minute += $token->current_minuts;
                }
            }
        }

        return Inertia::render('admin_pages/Finance/subscribers',[
            'users' => $subscriber,
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
    public function edit_plan(Request $request,string $id)
    {
        $Plan = Plan::find($id);

        $status = filter_var($request->get('status'), FILTER_VALIDATE_BOOLEAN);

        $request->validate([
            'price' => 'required || numeric',
            'currency' => 'required',
            'words' => 'required',
            'image' => 'required',
            'minute' => 'required',
            'frequency' => 'required',
            'status' => 'required',
        ]);

        $Plan->price = $request->price;
        $Plan->currency = $request->currency;
        $Plan->words = $request->words;
        $Plan->image = $request->image;
        $Plan->minute = $request->minute;
        $Plan->frequency = $request->frequency;
        $Plan->status = $status;

        $Plan->save();

        return Redirect::back()->with('success','edit plan successfuly');
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
        Plan::where('id', $id)
        ->forceDelete();

        return Redirect::back()->with('success','delete Plan successfuly');
    }
}
