<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>編集画面</h1>    
        @php
            $user = Auth::user();
        @endphp
        @if($user && $user->profile)
        <div class='view'>
        <p class='name'>{{$user->name}}</p>
        <p class='gender'>{{$profile->gender}}</p>
        <p class='old'>{{$profile->old}}</p>
        <p class='comment'>{{$profile->comment}}</p>
        </div>
        <h2 class='link'>    
        <a href="/postown">自分の投稿を確認する</a>
        <a href="/postothers">他人の投稿を確認する</a>
        </h2>
        @else
        <a href= "/profilecreate">プロフィール編集がまだの方はこちらへ</a>
        @endif
        
        
        
        <div class="footer">        
            <a href="/">戻る</a>
        </div>
    </body>
</html>