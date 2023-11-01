<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Category;
use App\Models\Record;
use App\models\User;
use \Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest; 
use App\Http\Requests\TodayRequest; 




class PostController extends Controller
{   
    
  
    
    public function delete(Category $category){
        $category->delete();
        return redirect("/recordset");
        
    }
    public function delete1(Category $category){
        $user=Auth::user();
        $categories=$user->categories()->orderBy('created_at','desc')->get();
        return view('posts.delete1')->with('categories',$categories)->with('user',$user);
    }
    
    
    public function front(){
        return view('posts.front');
    }
    
     public function postothers(Record $record , Category $category){
        $allUsers = User::all();
        $latestTotal = [];
        $latestTime = 0;
        $comments=[];

        foreach ($allUsers as $allUser) {
        $latestRecord = $allUser->records()->orderByDesc('created_at')->first();
        
        if ($latestRecord) {
        $decodedLatests = json_decode($latestRecord->category_total, true);

        foreach ($decodedLatests as $categoryName => $categoryTime) {
            if (array_key_exists($categoryName, $latestTotal)) {
                $latestTotal[$categoryName] += (int)$categoryTime;
            } else {
                $latestTotal[$categoryName] = (int)$categoryTime;
            }
            $latestTime += (int)$categoryTime;
            $comments[$categoryName] = $latestRecord->comment;
        }
    }
        }
        
        return view('posts.post_others',compact('latestTotal','latestTime','comments'));
    }
    
    public function postown(Record $record){
    $user = Auth::user();
    $categoryTotal = [];
    $totalTime = 0;
    $user = Auth::user();
    $comments = array();
    $matchingRecords = $user->records()->orderByDesc('created_at')->get();
    $categoryNameToIds = [];
    foreach ($matchingRecords as $matchingRecord) {
        $decodedCategory = json_decode($matchingRecord->category_total, true);

        if (!empty($decodedCategory)) {
            foreach ($decodedCategory as $categoryName => $categoryTime) {
                $categoryTime = (int)$categoryTime;

                if (!isset($categoryTotal[$categoryName])) {
                    $categoryTotal[$categoryName] = 0;
                }

                $categoryTotal[$categoryName] += $categoryTime;
                $totalTime += $categoryTime;
                $categoryNameToIds[$categoryName] = $matchingRecord->comment;
                
            }
            
            //var_export($categoryTotal);
        }
    }
   
    return view('posts.post_own', compact('categoryTotal', 'totalTime','categoryNameToIds','user'));
}
    
    public function posted(){
        return view('posts.posted');
    }
    public function post1(){
        return view('posts.week');
    }
    
    public function profilecreate(){
        return view('posts.profile_create');
    }
    
    
   public function profilestore(Request $request, Profile $profile) {
    $user = Auth::user();
    $name = $request->input('name');
    $gender = $request->input('gender');
    $old = $request->input('old');
    $comment = $request->input('comment');
    
    if (empty($name)) {
        return back()->with('error', '氏名は必須項目です。');
        }
     if (empty($gender)) {
        return back()->with('error', '性別は必須項目です。');
        }
     if (empty($old)) {
        return back()->with('error', '年齢は必須項目です。');
        }
        
     $profile = $user->profile ?? new Profile(); // プロフィールが存在しない場合は新しいプロフィールを作成
     $profile->user_id = $user->id;
        $profile->gender = $gender;
        $profile->old = $old;
        $profile->comment = $comment;
        $profile->save();
        $user->name = $name;
        $user->save();

    return redirect('/profile1');
}

    public function profile1(Profile $profile){
        $user = Auth::user();
        
        if(!$user->profile){
            return view('/posts.profile_create');
        }
        
        $profile=$user->profile;
        
        Carbon::setLocale('ja');
        $currentDateTime = Carbon::now(); 
        
        
        $matchingCategories = $user->categories()
            ->whereDate('created_at', '=', $currentDateTime->toDateString())
            ->get();
        
        
        $records = $user->records()->orderBy('created_at', 'desc')->get();
    
        if ($matchingCategories->isEmpty()) {
            //return response()->json(['error' => 'No matching category found']);
            $categoryTotal = [];
            //dd($records);
            return view('posts.profile1', compact('user','records','profile','categoryTotal'));
        }
    
        $categoryTotal = [];
        $totalTime = 0;

        foreach ($matchingCategories as $category) {
            $categoryName = $category->name;
            $categoryTime = $category->workTime;
    
            if (!isset($categoryTotal[$categoryName])) {
                $categoryTotal[$categoryName] = 0;
            }
    
            $categoryTotal[$categoryName] += $categoryTime;
            $totalTime += $categoryTime;
    }
        return view('posts.profile1', compact('user','records','categoryTotal','totalTime','profile'));
    }
    public function recordset(Category $category){
        return view('posts.record_set')->with(['category'=>$category]);
    }
    
    public function showRegisrationForm(){
        return view('posts.register');
    }
    
    public function storerecord( Category $category,PostRequest $request){
        $user_id = auth()->user()->id;
        $category->user_id = $user_id; 
        $name=$request->input('name');
        $time=(int)$request->input('workTime');
        $category->name=$name;
        $category->workTime=$time;
        $category->save();
       return redirect('/week');
    }
    
    public function storetoday(TodayRequest $request,Record $record){
            $user=Auth::user();
            if (!$user) {
                   return response()->json(['error' => 'ユーザーが認証されていません']);
                }
            $category=$user->categories->first();
             if (!$category) {
                   return response()->json(['error' => 'ユーザーに関連付けられたカテゴリーが見つかりません']);
                }
            $record = new Record();
            $category_id=$category->id;
            $record->category_id=$category_id;
            $record->user_id = auth()->user()->id; // ログインユーザーのIDを設定
// 他のカラムの値を設定...
            //$record->save();
            Carbon::setLocale('ja');
            $currentDateTime = now();
            if(!$user){
                return response()->json(['erros'=>'ユーザーが認証されていません']);
            }
            $matchingCategories = $user->categories()->whereDate('created_at', '=', $currentDateTime->toDateString())->get();
            if ($matchingCategories->isEmpty()) {
                return response()->json(['error' => '該当するカテゴリーが見つかりません']);
            }
            $categoryTotal = [];
            $totalTime = 0;
            foreach ($matchingCategories as $category) {
                $categoryName = $category->name;
                $categoryTime = $category->workTime;     

                if (!isset($categoryTotal[$categoryName])) {
                    $categoryTotal[$categoryName] = 0;
                }

                $categoryTotal[$categoryName] += $categoryTime;
                $totalTime += $categoryTime;
                
            }
            //$record = new Record();
            $record->category_total = json_encode($categoryTotal);
            $record->total_time = $totalTime; 
            $record->comment=$comment=$request->input('comment');
            $record->save();
        return redirect('/posted');
    }
    public function today(Record $record){
            $user=Auth::user();
            Carbon::setLocale('ja');
            $currentDateTime = now();
            if(!$user){
                return response()->json(['erros'=>'ユーザーが認証されていません']);
            }
            $matchingCategories = $user->categories()->whereDate('created_at', '=', $currentDateTime->toDateString())->get();
            if ($matchingCategories->isEmpty()) {
                return response()->json(['error' => '該当するカテゴリーが見つかりません']);
            }
            $categoryTotal = [];
            $totalTime = 0;
            foreach ($matchingCategories as $category) {
                $categoryName = $category->name;
                $categoryTime = $category->workTime;     

                if (!isset($categoryTotal[$categoryName])) {
                    $categoryTotal[$categoryName] = 0;
                }

                $categoryTotal[$categoryName] += $categoryTime;
                $totalTime += $categoryTime;
                
            }

        return view('posts.today',compact('categoryTotal', 'totalTime'));    
    }
    
    
    public function webtop(){
        return view('posts.webtop');
    }

    public function week()
{
    $user = Auth::user();
    Carbon::setLocale('ja');
    $currentDateTime = Carbon::now(); 

    if (!$user) {
        return response()->json(['errors' => 'User is not authenticated']);
    }

    $matchingCategories = $user->categories()
        ->whereDate('created_at', '=', $currentDateTime->toDateString())
        ->get();

    $records = $user->records()->orderBy('created_at', 'desc')->get();


    if ($matchingCategories->isEmpty()) {
        return response()->json(['error' => 'No matching category found']);
    }

    $categoryTotal = [];
    $totalTime = 0;

    foreach ($matchingCategories as $category) {
        $categoryName = $category->name;
        $categoryTime = $category->workTime;

        if (!isset($categoryTotal[$categoryName])) {
            $categoryTotal[$categoryName] = 0;
        }

        $categoryTotal[$categoryName] += $categoryTime;
        $totalTime += $categoryTime;
    }
   // dd($records);
    return view('posts.week', compact('categoryTotal', 'totalTime', 'records'));
}

public function example(){
    return view ('posts.example');
}

}
//k
