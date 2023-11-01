<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        @extends('layouts.common')
    </head>
    <body>
        @section('content')
       <div class='categories'>
        <h1 class = 'select'>削除するものを選択する</h1>
        <a href="/">戻る</a>
       @if($user && $user->categories)
       @foreach($categories as $category)
            <div class='category'>
                <p class="name">    カテゴリ名:   {{$category->name}}</p>
                <p class="workTime">    時間:   {{$category->workTime}}</p>
                <form action="/delete/{{$category->id}}" id="form_{{$category->id}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{$category->id}})" >削除</button>
                </form>   
            </div>
        @endforeach
        @else
         <h1>記録がありません。</h1>
        @endif
        
        <script>
            function deletePost(id){
                'use strict'
                if (confirm('削除すると復元できません/削除しますか')){
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
       </div>
        <div class="footer">
                <a href="/front">戻る</a>
        </div>
        @endsection
    </body>
</html>