<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
       <div class='categories'>
       @if($user && $user->categories)
       @foreach($user->categories as $category)
            <div class='category'>
                <p class="name">{{$category->name}}</p>
                <p class="workTime">{{$category->workTime}}</p>
                <form action="/recordset/{{$category->id}}" id="form_{{$category->id}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{$category->id}})" method="post">削除</button>
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
                    document.getElementById('form_id').submit();
                }
            }
        </script>
       </div>
        <div class="footer">
                <a href="/">戻る</a>
        </div>
    </body>
</html>