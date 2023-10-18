<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        @extends('layouts.common')
    </head>
    <body>
            @section('content')
            <h1>今までの記録</h1>
            @if(isset($categoryTotal))
            @foreach($categoryTotal as $categoryName=>$categoryTime)
                <div class='categorytotal'>
                    <p class='name'>カテゴリ名：{{$categoryName}}</p>
                    <p class='time'>時間：{{$categoryTime}}</p>
                    
                 </div>    
            @if(isset($categoryNameToIds[$categoryName]))
                    @php
                        $comment = $categoryNameToIds[$categoryName];
                    @endphp
                    <p class='comments'>コメント：{{$comment}}</p>
                @endif
            @endforeach
            
            @else
                <p class='noRecords'>記録がありません</p>
            @endif
            <a href="{{ route('profile1') }}">戻る</a>
       @endsection
        
    </body>
</html>