<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        
    </head>
    <body>
              今日のグラフ
              今週のグラフ
        @if(isset($categoryTotal)&&!empty($categoryTotal))
        @foreach($categoryTotal as $categoryName=>$categoryTime)
            <div class='categorytotal'>
                <p class='name'>カテゴリ名：{{$categoryName}}</p>
                <p class='time'>時間：{{$categoryTime}}</p>
            </div>    
        @endforeach
        @else<h1>記録がありません</h1>
        @endif
            <a href='/today'>今日の記録を確定する</a>
            <div class="footer">
                <a href="/">戻る</a>
            </div>
    </body>
</html>