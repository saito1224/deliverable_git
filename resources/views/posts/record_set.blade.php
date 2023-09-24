<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        
    </head>
    <body>
        <h1>活動を記録する</h1>
        <form action="/storerecord" method="POST">
            @csrf
            <div class="category">
                <h2>カテゴリー名入力</h2>
                <input type="text" name="name" placeholder="カテゴリー名"/>
            </div>
            <div class="time">
                <h2>時間入力</h2>
                <input type = "text" name="workTime" placeholder="活動時間/分"/>
            </div>
            <input type="submit" value="記録確定"/>
        </form>
        <div class=button>
        <a　href= "/delete1"><h3>投稿削除</h3></a>
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>