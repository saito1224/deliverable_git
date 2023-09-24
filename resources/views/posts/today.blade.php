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
          <form action='/storetoday' method="post">
            @csrf
            @if(isset($categoryTotal))
            @foreach($categoryTotal as $categoryName=>$categoryTime)
                <div class='categorytotal'>
                    <p class='name'>カテゴリ名：{{$categoryName}}</p>
                    <p class='time'>時間：{{$categoryTime}}</p>
                 </div>    
            @endforeach
            @endif
                <div class="comment">
                    <h2>コメント入力</h2>
                    <input type="text" name="comment" placeholder="コメント"/>
                </div>
                    <input type="submit" value="記録確定"/> 
          </form>
        <div class="footer">        
            <a href="/">戻る</a>
        </div>
    </body>
</html>