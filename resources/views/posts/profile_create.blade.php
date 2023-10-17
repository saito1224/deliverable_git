<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        @extends('layouts.common')

    </head>
    <body>
        @section('content')
        <h1>編集画面</h1>    
        <form action="/profilestore" method="POST">
            @csrf
             @php
                $user = Auth::user();
             @endphp
            <div class="name">
                <h2>ユーザー名入力</h2>
                <input type="text" name="name" placeholder="ユーザー名"  value="{{$user->name}}" />
            </div>
            <div class="other">
                <h3>性別入力</h3>
                <label>
                    <input type="radio" name="gender" value="男性">男性
                </label>
                <label>
                    <input type="radio" name="gender" value="女性">女性
                </label>
                <label>
                    <input type="radio" name="gender" value="その他">その他
                </label>
                <input type="text" name="old" placeholder="年齢">
                <input type="text" name="comment" placeholder="ひとこと">
            </div>

           　　　<input type="submit" value="編集確定">
        </form>
        <div class="footer">        
            <a href="/">戻る</a>
        </div>
        @endsection
    </body>
</html>