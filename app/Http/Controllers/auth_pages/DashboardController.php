<?php

namespace App\Http\Controllers\auth_pages;

use App\Http\Controllers\Controller;
use App\Models\Favorite_tool;
use Illuminate\Support\Facades\DB;
use App\Models\Subscription;
use App\Models\Token_tracker;
use App\Models\Tool;
use App\Models\Tools_data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $tokens = Token_tracker::where('id_user',Auth::user()->id)
        ->select(
            DB::raw('COALESCE(ROUND(SUM(token_trackers.current_words), 3), 0) as current_words'),
            DB::raw('COALESCE(ROUND(SUM(token_trackers.current_images), 3), 0) as current_images'),
            DB::raw('COALESCE(ROUND(SUM(token_trackers.current_minuts), 3), 0) as current_minuts')
        )
        ->get();

        $tokens_totla=Subscription::where('id_user',Auth::user()->id)
        ->select(
            DB::raw('COALESCE(ROUND(SUM(subscriptions.max_word), 3), 0) as max_word'),
            DB::raw('COALESCE(ROUND(SUM(subscriptions.max_image), 3), 0) as max_image'),
            DB::raw('COALESCE(ROUND(SUM(subscriptions.max_minute), 3), 0) as max_minute')
                )
        ->get();

        $rendom_tools = Tool::take(8)
        ->orderByRaw('RAND()')
        ->get();

        $favorit_tools = Favorite_tool::join('tools', 'tools.id', '=', 'favorite_tools.id_tool')
        ->where('id_user',Auth::user()->id)
        ->get();

        $last_data = Tools_data::select(
            'tools.id',
            'tools.logo',
            'tools.color',
            'tools.logo_color',
            'tools_datas.title',
            'tools_datas.type_data',
            'tools_datas.created_at',
            )
        ->join('tools','tools.id','=','tools_datas.id_tool')
        ->where('id_user',Auth::user()->id)
        ->orderBy('created_at','desc')
        ->take(8)
        ->get();

        
        $tokens_chart = Token_tracker::where('id_user', Auth::user()->id)
        ->select(
            DB::raw('COALESCE(ROUND(SUM(token_trackers.current_words), 3), 0) as current_words'),
            DB::raw('COALESCE(ROUND(SUM(token_trackers.current_images), 3), 0) as current_images'),
            DB::raw('COALESCE(ROUND(SUM(token_trackers.current_minuts), 3), 0) as current_minuts'),
            DB::raw('DATE(created_at) as date')
        )
        ->groupBy(DB::raw('DATE(created_at)'))
        ->limit(7)
        ->orderBy(DB::raw('MIN(created_at)'), 'asc')
        ->get();
    
        $words = [];
        foreach ($tokens_chart as $token) {
            $words[] = $token->current_words;
        }

        $images = [];
        foreach ($tokens_chart as $token) {
            $images[] = $token->current_images;
        }

        $voice = [];
        foreach ($tokens_chart as $token) {
            $voice[] = $token->current_minuts;
        }

        $date = [];
        foreach ($tokens_chart as $token) {
            $date[] = $token->date;
        }

        $tokens_bar = Token_tracker::where('id_user', Auth::user()->id)
        ->where('current_words','!=',null)
        ->select('tools.title',
                DB::raw('COALESCE(current_words, 0) as current_words'))
        ->join('tools','tools.id','=','token_trackers.id_tool')
        ->take(7)
        ->orderBy('current_words', 'desc')
        ->get();
    
        $token_title = [];
        foreach ($tokens_bar as $token) {
            $token_title[] = $token->title;
        }

        $tools_tokens = [];
        foreach ($tokens_bar as $token) {
            $tools_tokens[] = $token->current_words;
        }

        return Inertia::render('auth_pages/Dashboard/index',[
            'rendom_tools'=>$rendom_tools,
            'tokens'=>$tokens,
            'tokens_totla'=>$tokens_totla,
            'favorit_tools'=>$favorit_tools,
            'last_data' => $last_data,
            'words' => $words,
            'images' => $images,
            'voice' => $voice,
            'date' => $date,
            'tools_title' => $token_title,
            'tools_tokens' => $tools_tokens,
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
