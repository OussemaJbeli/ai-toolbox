<?php

namespace App\Http\Middleware;


use App\Models\Favorite_sub_categorie;
use App\Models\Favorite_tool;
use App\Models\Tool;
use App\Models\Custom_categorie;
use App\Models\Favorite_original_categorie;
use App\Models\Original_categorie;
use App\Models\Recent_tool;
use App\Models\Sub_categorie;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use Carbon\Carbon;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    private function check_subscription(){
        $user = User::where('id',Auth::user()->id)->where('special_user','!=',true)->first();
        $current_date =  Carbon::now();

        if ($user) {
            Subscription::where('id_user', $user->id)
                    ->where('date_end', '<', $current_date)
                    ->delete();

            $Subscriptions = Subscription::where('id_user', $user->id)->count();
    
            if ($Subscriptions == 0) {

                $user->payment = false;
                $user->save();
            }
        }
    }
    private function favorit_tool($index){
        $userID = Auth::user()->id;
        switch ($index) {
            case 'AiImage':
                $tab = Tool::select('tools.*','favorite_tools.id_tool')
                ->leftJoin('favorite_tools',
                    function($join) use ($userID){
                        $join->on('tools.id','=','favorite_tools.id_tool')
                        ->where('favorite_tools.id_user',$userID);
                    }
                )
                ->join('tool_original_categories', 'tool_original_categories.id_tool', '=', 'tools.id')
                ->join('original_categories', 'original_categories.id', '=', 'tool_original_categories.id_categorie')
                ->where('original_categories.name','Image Generator')
                ->get();
                break;
            case 'AiCode':
                $tab = Tool::select('tools.*','favorite_tools.id_tool')
                ->leftJoin('favorite_tools',
                    function($join) use ($userID){
                        $join->on('tools.id','=','favorite_tools.id_tool')
                        ->where('favorite_tools.id_user',$userID);
                    }
                )
                ->join('tool_original_categories', 'tool_original_categories.id_tool', '=', 'tools.id')
                ->join('original_categories', 'original_categories.id', '=', 'tool_original_categories.id_categorie')
                ->where('original_categories.name','Code Generator')
                ->get();
                break;
            case 'AiChat':
                $tab =Tool::select('tools.*','favorite_tools.id_tool')
                ->leftJoin('favorite_tools',
                    function($join) use ($userID){
                        $join->on('tools.id','=','favorite_tools.id_tool')
                        ->where('favorite_tools.id_user',$userID);
                    }
                )
                ->join('tool_original_categories', 'tool_original_categories.id_tool', '=', 'tools.id')
                ->join('original_categories', 'original_categories.id', '=', 'tool_original_categories.id_categorie')
                ->where('original_categories.name','Chat Bot')
                ->get();
                break;
            case 'AiSpeech':
                $tab =Tool::select('tools.*','favorite_tools.id_tool')
                ->leftJoin('favorite_tools',
                    function($join) use ($userID){
                        $join->on('tools.id','=','favorite_tools.id_tool')
                        ->where('favorite_tools.id_user',$userID);
                    }
                )
                ->join('tool_original_categories', 'tool_original_categories.id_tool', '=', 'tools.id')
                ->join('original_categories', 'original_categories.id', '=', 'tool_original_categories.id_categorie')
                ->where('original_categories.name','Voice Generator')
                ->get();
                break;
        }
        return $tab;
    }
    private function favorit_tool_text($index){
        $userID = Auth::user()->id;
        switch ($index) {
            case 'undercat1':
                $tab = Tool::select('tools.*','favorite_tools.id_tool')
                ->leftJoin('favorite_tools',
                    function($join) use ($userID){
                        $join->on('tools.id','=','favorite_tools.id_tool')
                        ->where('favorite_tools.id_user',$userID);
                    }
                )
                ->join('tool_sub_categories', 'tool_sub_categories.id_tool', '=', 'tools.id')
                ->join('sub_categories', 'sub_categories.id', '=', 'tool_sub_categories.id_categorie')
                ->where('sub_categories.name','Article Generator')
                ->get();
                break;

                case 'undercat2':
                    $tab = Tool::select('tools.*','favorite_tools.id_tool')
                    ->leftJoin('favorite_tools',
                        function($join) use ($userID){
                            $join->on('tools.id','=','favorite_tools.id_tool')
                            ->where('favorite_tools.id_user',$userID);
                        }
                    )
                    ->join('tool_sub_categories', 'tool_sub_categories.id_tool', '=', 'tools.id')
                    ->join('sub_categories', 'sub_categories.id', '=', 'tool_sub_categories.id_categorie')
                    ->where('sub_categories.name','Ecommerce')
                    ->get();
                    break;

                    case 'undercat3':
                        $tab = Tool::select('tools.*','favorite_tools.id_tool')
                        ->leftJoin('favorite_tools',
                            function($join) use ($userID){
                                $join->on('tools.id','=','favorite_tools.id_tool')
                                ->where('favorite_tools.id_user',$userID);
                            }
                        )
                        ->join('tool_sub_categories', 'tool_sub_categories.id_tool', '=', 'tools.id')
                        ->join('sub_categories', 'sub_categories.id', '=', 'tool_sub_categories.id_categorie')
                        ->where('sub_categories.name','Emails')
                        ->get();
                        break;

                        case 'undercat4':
                            $tab = Tool::select('tools.*','favorite_tools.id_tool')
                            ->leftJoin('favorite_tools',
                                function($join) use ($userID){
                                    $join->on('tools.id','=','favorite_tools.id_tool')
                                    ->where('favorite_tools.id_user',$userID);
                                }
                            )
                            ->join('tool_sub_categories', 'tool_sub_categories.id_tool', '=', 'tools.id')
                            ->join('sub_categories', 'sub_categories.id', '=', 'tool_sub_categories.id_categorie')
                            ->where('sub_categories.name','Frameworks')
                            ->get();
                            break;

                            case 'undercat5':
                                $tab = Tool::select('tools.*','favorite_tools.id_tool')
                                ->leftJoin('favorite_tools',
                                    function($join) use ($userID){
                                        $join->on('tools.id','=','favorite_tools.id_tool')
                                        ->where('favorite_tools.id_user',$userID);
                                    }
                                )
                                ->join('tool_sub_categories', 'tool_sub_categories.id_tool', '=', 'tools.id')
                                ->join('sub_categories', 'sub_categories.id', '=', 'tool_sub_categories.id_categorie')
                                ->where('sub_categories.name','Marketing')
                                ->get();
                                break;

                                case 'undercat6':
                                    $tab = Tool::select('tools.*','favorite_tools.id_tool')
                                    ->leftJoin('favorite_tools',
                                        function($join) use ($userID){
                                            $join->on('tools.id','=','favorite_tools.id_tool')
                                            ->where('favorite_tools.id_user',$userID);
                                        }
                                    )
                                    ->join('tool_sub_categories', 'tool_sub_categories.id_tool', '=', 'tools.id')
                                    ->join('sub_categories', 'sub_categories.id', '=', 'tool_sub_categories.id_categorie')
                                    ->where('sub_categories.name','Social Media')
                                    ->get();
                                    break;

                                    case 'undercat7':
                                        $tab = Tool::select('tools.*','favorite_tools.id_tool')
                                        ->leftJoin('favorite_tools',
                                            function($join) use ($userID){
                                                $join->on('tools.id','=','favorite_tools.id_tool')
                                                ->where('favorite_tools.id_user',$userID);
                                            }
                                        )
                                        ->join('tool_sub_categories', 'tool_sub_categories.id_tool', '=', 'tools.id')
                                        ->join('sub_categories', 'sub_categories.id', '=', 'tool_sub_categories.id_categorie')
                                        ->where('sub_categories.name','Websites')
                                        ->get();
                                        break;

                                        case 'undercat8':
                                            $tab = Tool::select('tools.*','favorite_tools.id_tool')
                                            ->leftJoin('favorite_tools',
                                                function($join) use ($userID){
                                                    $join->on('tools.id','=','favorite_tools.id_tool')
                                                    ->where('favorite_tools.id_user',$userID);
                                                }
                                            )
                                            ->join('tool_sub_categories', 'tool_sub_categories.id_tool', '=', 'tools.id')
                                            ->join('sub_categories', 'sub_categories.id', '=', 'tool_sub_categories.id_categorie')
                                            ->where('sub_categories.name','Blog Posts')
                                            ->get();
                                            break;
        }
        return $tab;
    }
    private function favorit_categorie($index){
        $userID = Auth::user()->id;

        switch ($index) {
            case 'categorie':
                $tab = Original_categorie::select('original_categories.*','favorite_original_categories.id_categorie')
                ->leftJoin('favorite_original_categories',
                    function($join) use ($userID){
                        $join->on('original_categories.id','=','favorite_original_categories.id_categorie')
                        ->where('favorite_original_categories.id_user',$userID);
                    }
                )
                ->get();
                break;
            case 'sub_cat':
                $tab = Sub_categorie::select('sub_categories.*','favorite_sub_categories.id_categorie')
                ->leftJoin('favorite_sub_categories',
                    function($join) use ($userID){
                        $join->on('sub_categories.id','=','favorite_sub_categories.id_categorie')
                        ->where('favorite_sub_categories.id_user',$userID);
                    }
                )
                ->get();
                break;
                    
        }
        return $tab;
    }
    private function tools(){
        $userID = Auth::user()->id;

        $tab = Tool::select('tools.*','favorite_tools.id_tool')
        ->leftJoin('favorite_tools',
            function($join) use ($userID){
                $join->on('tools.id','=','favorite_tools.id_tool')
                ->where('favorite_tools.id_user',$userID);
            }
        )
        ->get();

        return $tab;
    }
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => function () use ($request) {
                return [
                    'user' => $request->user() ? [
                        'id' => $request->user()->id,
                        'name' => $request->user()->name,
                        'email' => $request->user()->email,
                        'avatar' => $request->user()->avatar,
                        'sid_img' => $request->user()->sid_img,
                        'filter' => $request->user()->filter,
                        'darkMode' => $request->user()->darkMode,
                        'admin' => $request->user()->admin,
                        'super_user' => $request->user()->super_user,
                        'payment' => $request->user()->payment,
                        'special_user' => $request->user()->special_user,
                    ] : null,
                    'check_subscription' => $request->user() ? [
                        $this->check_subscription()
                    ] : null,
                    'user_plan' => $request->user() ? [
                        Subscription::join('users', 'users.id', '=', 'subscriptions.id_user')
                        ->join('plans', 'plans.id', '=', 'subscriptions.id_plan')
                        ->where('id_user',Auth::user()->id)
                        ->select('plans.*')
                        ->orderBy('plans.id','desc')
                        ->first()
                    ] : null,
                    'categories'=> $request->user() ? [                        
                        $this->favorit_categorie('categorie')
                    ] : null,
                    'tools'=> $request->user() ? [                        
                        $this->tools()
                    ] : null,
                    'favorit_tools'=> $request->user() ? [                        
                        Favorite_tool::join('tools', 'tools.id', '=', 'favorite_tools.id_tool')
                        ->where('id_user',Auth::user()->id)
                        ->get()
                    ]: null,
                    'favorit_categories_custom' => $request->user() ? [
                        Custom_categorie::where('id_user', Auth::user()->id)
                        ->get()
                    ]: null,
                    'favorit_categories_original'=> $request->user() ? [                        
                        Favorite_original_categorie::select('original_categories.*')
                        ->join('original_categories','original_categories.id','=','favorite_original_categories.id_categorie')
                        ->where('id_user',Auth::user()->id)
                        ->get()
                    ]: null,
                    'favorit_sub_categorie'=> $request->user() ? [                        
                        Favorite_sub_categorie::select('sub_categories.*')
                        ->join('sub_categories','sub_categories.id','=','favorite_sub_categories.id_categorie')
                        ->where('id_user',Auth::user()->id)
                        ->get()
                    ]: null,
                    'AiText' => $request->user() ? [
                        'navbar'=>[  
                            $this->favorit_categorie('sub_cat')                      
                        ],
                        'undercat1'=>[
                            $this->favorit_tool_text('undercat1')
                        ],
                        'undercat2'=>[
                            $this->favorit_tool_text('undercat2')
                        ],
                        'undercat3'=>[
                            $this->favorit_tool_text('undercat3')
                        ],
                        'undercat4'=>[
                            $this->favorit_tool_text('undercat4')
                        ],
                        'undercat5'=>[
                            $this->favorit_tool_text('undercat5')
                        ],
                        'undercat6'=>[
                            $this->favorit_tool_text('undercat6')
                        ],
                        'undercat7'=>[
                            $this->favorit_tool_text('undercat7')
                        ],
                        'undercat8'=>[
                            $this->favorit_tool_text('undercat8')
                        ],


                    ] : null,
                    'AiImage' => $request->user() ? [
                        $this->favorit_tool('AiImage')
                    ] : null,
                    'AiCode' => $request->user() ? [
                        $this->favorit_tool('AiCode')
                    ] : null,
                    'AiChat' => $request->user() ? [
                        $this->favorit_tool('AiChat')
                    ] : null,
                    'AiSpeech' => $request->user() ? [
                        $this->favorit_tool('AiSpeech')
                    ] : null,
                    'recent'=> $request->user() ? [                        
                        Recent_tool::select('tools.*', 'recent_tools.updated_at')
                        ->where('id_user', Auth::user()->id)
                        ->join('tools', 'tools.id', '=', 'recent_tools.id_tool')
                        ->orderBy('recent_tools.updated_at', 'desc')
                        ->take(5)
                        ->get()                                   
                    ]: null,
                ];
            },
            
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'flash' => function () use ($request) {
                return [
                    'favorit_title' => $request->session()->get('favorit_title'),
                    'favorit_description' => $request->session()->get('favorit_description'),
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error'),
                ];
            },
        ]);
    }
}
