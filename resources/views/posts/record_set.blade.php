<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        @extends('layouts.common')
    </head>
    <body>
         @section('content')
        <h1>活動を記録する</h1>
        <form action="/storerecord" method="POST">
            @csrf
            <div class="category">
                <h2>カテゴリー名入力</h2>
                <input type="text" name="name" placeholder="カテゴリー名" value="{{ old('name') }}"/>
            </div>
            <div class="time">
                <h2>時間入力</h2>
                <input type = "text" name="workTime" placeholder="活動時間/分" value="{{ old('workTime') }}"/>
            </div>
            <input type="submit" value="記録確定"/>
            <p class="name__error" style="color:red">{{ $errors->first('name') }}</p>
　　        <p class="workTime__error" style="color:red">{{ $errors->first('workTime') }}</p>
        </form>
        <a href= "/delete1">投稿削除</a>
        <div class="footer">
            <a href="/front">戻る</a>
        </div>
    </body>
        @endsection
</html>

<!--

-->