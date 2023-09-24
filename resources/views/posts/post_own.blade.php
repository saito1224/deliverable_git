<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        
    </head>
    <body>
        
        <div class='categories'>
            @if(isset($categoryTotal))
            @foreach($categoryTotal as $categoryName=>$categoryTime)
                <div class='categorytotal'>
                    <p class='name'>カテゴリ名：{{$categoryName}}</p>
                    <p class='time'>時間：{{$categoryTime}}</p>
                    <p class='comment'>コメント：{{$comment}}</p>
                 </div>    
            @endforeach
            @else
                <p class='noRecords'>記録がありません</p>
            @endif
       
       
    </body>
</html>