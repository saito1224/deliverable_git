<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        URL::forceScheme('https'); 
        $this->app['request']->server->set('HTTPS','on');
       /* View::composer(['posts.week', 'posts.today'], function ($view){
            $user=Auth::user();
            Carbon::setLocale('ja');
            $currentDateTime = now();
            if(!$user){
                return response()->json(['erros'=>'ユーザーが認証されていません']);
            }
            if($view->getName()=='post_others'){
                $matchingCategories =categories()->whereDate('created_at','=',$curentDateTime->toDateString())->get();
            }
            else{
            $matchingCategories = $user->categories()->whereDate('created_at', '=', $currentDateTime->toDateString())->get();
            if ($matchingCategories->isEmpty()) {
                return response()->json(['error' => '該当するカテゴリーが見つかりません']);
            }
            $categoryTotal = [];
            $totalTime = 0;
            foreach ($matchingCategories as $category) {
                $categoryName = $category->name;
                $categoryTime = $category->time;     

                if (!isset($categoryTotal[$categoryName])) {
                    $categoryTotal[$categoryName] = 0;
                }

                $categoryTotal[$categoryName] += $categoryTime;
                $totalTime += $categoryTime;
            }
            session(['categoryTotal'=>$categoryTotal,'totalTime'=>$totalTime]);
            $view->with('categoryTotal', $categoryTotal)
                 ->with('totalTime', $totalTime);
            
}   
        });
    }*/
}
}
    

