<?php

namespace App\Http\Controllers\auth_pages;

use App\Http\Controllers\Controller;
use App\Models\Apiskey;
use Illuminate\Support\Facades\DB;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Token_tracker;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;
use Illuminate\Support\Facades\Redirect;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $plan = Plan::all();
        $subscriber = Subscription::where('subscriptions.id_user',Auth::user()->id)
            ->join('users','users.id','=','subscriptions.id_user')
            ->join('plans','plans.id','=','subscriptions.id_plan')
            ->leftJoin('token_trackers','token_trackers.id_user','=','subscriptions.id_user')
            ->select('subscriptions.id_user',
                    'plans.*',
                    'subscriptions.date_end',
                    'subscriptions.max_word',
                    'subscriptions.max_image',
                    'subscriptions.max_minute'
                    )
            ->groupBy('subscriptions.id_user',
                    'plans.id',
                    'subscriptions.date_end',
                    'subscriptions.max_word',
                    'subscriptions.max_image',
                    'subscriptions.max_minute'
                    )
            ->get();

        $subscriber_usage=Subscription::where('id_user',Auth::user()->id)
        ->select(
            'subscriptions.id_user',
            DB::raw('ROUND(SUM(subscriptions.max_word), 3) as max_word'),
            DB::raw('ROUND(SUM(subscriptions.max_image), 3) as max_image'),
            DB::raw('ROUND(SUM(subscriptions.max_minute), 3) as max_minute'),
                )
        ->groupBy('subscriptions.id_user')
        ->get();

        $tokens = Token_tracker::where('id_user',Auth::user()->id)
            ->select(
                DB::raw('ROUND(SUM(token_trackers.current_words), 3) as usage_words'),
                DB::raw('ROUND(SUM(token_trackers.current_images), 3) as usage_images'),
                DB::raw('ROUND(SUM(token_trackers.current_minuts), 3) as usage_minuts'),
            )
            ->get();

        $secretKey = Apiskey::where('title','stripe public key')->select('key')->first();
        
        return Inertia::render('auth_pages/Subscription/index',[
            'plan' => $plan,
            'subscriber' => $subscriber,
            'subscriber_usage' => $subscriber_usage,
            'tokens' => $tokens ,
            'secretKey' => $secretKey
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function Payment(string $id_plan)
    {
        $secretKey = Apiskey::where('title','stripe secret key')->select('key')->first();
        
        $Plan = Plan::find($id_plan);
        
        $title = $Plan->title;
        $currency = $Plan->currency;
        $price = $Plan->price;

        Stripe::setApiKey($secretKey['key']);

        try {
            $session = CheckoutSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => $currency,
                        'product_data' => [
                            'name' => $title,
                        ],
                        'unit_amount' => (int)round($price * 100),
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('Subscription.payment_success', ['id_plan' => $id_plan]), 
                'cancel_url' =>  route('Subscription.payment_failed'),
            ]);
            return response()->json(['id' => $session->id]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }

    public function payment_success(string $id_plan){

        $subscription = Subscription::where('id_user',Auth::user()->id)
        ->where('id_plan',$id_plan)
        ->first();

        $user = User::find(Auth::user()->id);
        $user->payment = true;
        $user->save();

        $Plan = Plan::find($id_plan);

        if($subscription){
            if($id_plan > $subscription->id_plan)
                $subscription->id_plan = $id_plan;
            
            $subscription->max_word += $Plan->words;
            $subscription->max_image += $Plan->image;
            $subscription->max_minute += $Plan->minute;
            
            $subscription->save();
    
            return Redirect::back()->with('success','subscription successfuly');
        }

        $subscription = new Subscription();

        $subscription->id_user = Auth::user()->id ;
        $subscription->id_plan = $id_plan;
        $subscription->max_word = $Plan->words;
        $subscription->max_image = $Plan->image;
        $subscription->max_minute = $Plan->minute;
        
        if($Plan->freaquency == "year")
            $subscription->date_end =  now()->addYear();
        else
            $subscription->date_end =  now()->addMonth();

        $subscription->save();

        return Inertia::render('auth_pages/Subscription/payment_success');
    }

    public function payment_failed(){
        return Inertia::render('auth_pages/Subscription/payment_failed');
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
