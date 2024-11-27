<?php

namespace App\Http\Controllers\admin_pages;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Token_tracker;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use DateTime;

class Dashboard_adminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();
        $currentYearStart = Carbon::now()->startOfYear();
        $currentYearEnd = Carbon::now()->endOfYear();
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        $tokens_this_month = Token_tracker::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
        ->select(
            DB::raw('COALESCE(ROUND(SUM(token_trackers.current_words), 3), 0) as current_words'),
            DB::raw('COALESCE(ROUND(SUM(token_trackers.current_images), 3), 0) as current_images'),
            DB::raw('COALESCE(ROUND(SUM(token_trackers.current_minuts), 3), 0) as current_minuts'),
        )
        ->get();

        $tokens_this_year = Token_tracker::whereBetween('created_at', [$currentYearStart, $currentYearEnd])
        ->select(
            DB::raw('COALESCE(ROUND(SUM(token_trackers.current_words), 3), 0) as current_words'),
            DB::raw('COALESCE(ROUND(SUM(token_trackers.current_images), 3), 0) as current_images'),
            DB::raw('COALESCE(ROUND(SUM(token_trackers.current_minuts), 3), 0) as current_minuts'),
        )
        ->get();

        $tokens_last_month = Token_tracker::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
        ->select(
            DB::raw('COALESCE(ROUND(SUM(token_trackers.current_words), 3), 0) as current_words'),
            DB::raw('COALESCE(ROUND(SUM(token_trackers.current_images), 3), 0) as current_images'),
            DB::raw('COALESCE(ROUND(SUM(token_trackers.current_minuts), 3), 0) as current_minuts'),
        )
        ->get();
    
        $words = ['this_month'=>0,'this_year'=>0,'last_month'=>0];
        $images = ['this_month'=>0,'this_year'=>0,'last_month'=>0];
        $voice = ['this_month'=>0,'this_year'=>0,'last_month'=>0];

        foreach ($tokens_this_month as $token) {
            $words['this_month'] = $token->current_words;
            $images['last_month'] = $token->current_images;
            $voice['this_month'] = $token->current_minuts;
        }

        foreach ($tokens_this_year as $token) {
            $words['this_year'] = $token->current_words;
            $images['this_year'] = $token->current_images;
            $voice['this_year'] = $token->current_minuts;
        }

        foreach ($tokens_last_month as $token) {
            $words['last_month'] = $token->current_words;
            $images['last_month'] = $token->current_images;
            $voice['last_month'] = $token->current_minuts;
        }

        $currentMonth_users = User::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->count();
        $currentYear_users = User::whereBetween('created_at', [$currentYearStart, $currentYearEnd])->count();
        $lastMonthD_users = User::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();

        $currentMonth_subscriber = User::where('payment',true)->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->count();
        $currentYear_subscriber = User::where('payment',true)->whereBetween('created_at', [$currentYearStart, $currentYearEnd])->count();
        $lastMonthD_subscriber = User::where('payment',true)->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();

        $currentMonth_subscriptions = Subscription::withTrashed()
            ->whereBetween('subscriptions.created_at', [$currentMonthStart, $currentMonthEnd])
            ->select(DB::raw('COALESCE(ROUND(SUM(plans.price), 3), 0) as price'))
            ->join('plans','plans.id','=','subscriptions.id_plan')
            ->first();
        $currentYear_subscriptions = Subscription::withTrashed()
            ->whereBetween('subscriptions.created_at', [$currentYearStart, $currentYearEnd])
            ->select(DB::raw('COALESCE(ROUND(SUM(plans.price), 3), 0) as price'))
            ->join('plans','plans.id','=','subscriptions.id_plan')
            ->first();
        $lastMonthD_subscriptions = Subscription::withTrashed()
            ->whereBetween('subscriptions.created_at', [$lastMonthStart, $lastMonthEnd])
            ->select(DB::raw('COALESCE(ROUND(SUM(plans.price), 3), 0) as price'))
            ->join('plans','plans.id','=','subscriptions.id_plan')
            ->first();

        //charts

        $tokens_chart = Token_tracker::select(
            DB::raw('COALESCE(ROUND(SUM(token_trackers.current_words), 3), 0) as current_words'),
            DB::raw('COALESCE(ROUND(SUM(token_trackers.current_images), 3), 0) as current_images'),
            DB::raw('COALESCE(ROUND(SUM(token_trackers.current_minuts), 3), 0) as current_minuts'),
            DB::raw('DATE(created_at) as date')
        )
        ->groupBy(DB::raw('DATE(created_at)'))
        ->limit(7)
        ->orderBy(DB::raw('MIN(created_at)'), 'asc')
        ->get();
    
        $words_chart = [];
        foreach ($tokens_chart as $token) {
            $words_chart[] = $token->current_words;
        }

        $images_chart = [];
        foreach ($tokens_chart as $token) {
            $images_chart[] = $token->current_images;
        }

        $voice_chart = [];
        foreach ($tokens_chart as $token) {
            $voice_chart[] = $token->current_minuts;
        }

        $date_chart = [];
        foreach ($tokens_chart as $token) {
            $date_chart[] = $token->date;
        }

        $numberOfDays = Carbon::createFromDate($currentYear, $currentMonth)->daysInMonth;

        $currentMonthRegisters = [];
        $currentMonthdate = [];

        $registers = User::whereYear('created_at', $currentYear)
                        ->whereMonth('created_at', $currentMonth)
                        ->get()
                        ->groupBy(function($date) {
                            return Carbon::parse($date->created_at)->format('d');
                        });

        for ($day = 1; $day <= $numberOfDays; $day++) {
            $currentMonthdate[] = $day;
            $dayString = str_pad($day, 2, '0', STR_PAD_LEFT);

            if (isset($registers[$dayString])) {
                $currentMonthRegisters[] = $registers[$dayString]->count();
            }
        }

        $currentYear = Carbon::now()->year;

        $yearlyRegisters = User::whereYear('created_at', $currentYear)
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            })
            ->map(function ($item, $key) {
                return $item->count();
            });
        
        $monthNames = [];
        $currentYearRegisters = [];
        
        for ($month = 1; $month <= 12; $month++) {
            $monthNames[] = Carbon::createFromDate($currentYear, $month)->format('M');
            $monthString = str_pad($month, 2, '0', STR_PAD_LEFT);
        
            if (isset($yearlyRegisters[$monthString])) {
                $currentYearRegisters[] = $yearlyRegisters[$monthString];
            }
        }

        return Inertia::render('admin_pages/Dashboard/index',[
            'words' => $words,
            'images' => $images,
            'voice' => $voice,
            //users
            'currentMonth_users' => $currentMonth_users,
            'currentYear_users' => $currentYear_users,
            'lastMonthD_users' => $lastMonthD_users,
            //subs
            'currentMonth_subscriber' => $currentMonth_subscriber,
            'currentYear_subscriber' => $currentYear_subscriber,
            'lastMonthD_subscriber' => $lastMonthD_subscriber,
            //payment
            'currentMonth_subscriptions' => $currentMonth_subscriptions,
            'currentYear_subscriptions' => $currentYear_subscriptions,
            'lastMonthD_subscriptions' => $lastMonthD_subscriptions,

            //charts
            'words_chart' => $words_chart,
            'images_chart' => $images_chart,
            'voice_chart' => $voice_chart,
            'date_chart' => $date_chart,

            'currentMonthRegisters' => $currentMonthRegisters,
            'currentMonthdate' => $currentMonthdate,

            'monthNames' => $monthNames,
            'currentYearRegisters' => $currentYearRegisters,
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
