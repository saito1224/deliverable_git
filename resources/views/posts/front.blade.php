<!DOCTYPE HTML>
<!--front.blade.php-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!--posts.front-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        @extends('layouts.common')
        <style>
        .link {
            
                margin-bottom: 0px; /* リンク間の余白を指定 */
                font-size: 20px; /* リンクのテキストサイズを調整（任意のサイズに変更） */
            }
        .text-color{
            font-size:40;
        }
                /* ナビゲーションメニューのリンクテキストの色を変更 */
        /* ナビゲーションメニューのリンクテキストにホバー時の色を設定 */
        .view a:hover {
            color:#00ff00; /* リンクのテキストを緑色に設定（ホバー時） */
          
        </style>
    </head>
    <body>
         @section('content')
        <h2  class="text-color">メニュー</h2>
        <p class='link'>
            <a href="/recordset">記録する</a>
            <p>：活動の種類ごとに記録ができる</p><br><br>
            <a href="/profile1">プロフィール編集/記録を見る</a>
            <p>：プロフィールをまだ作成していない方はこちらへ。</p>
            <p>：今までの記録や他の人の記録を参照できます</p><br><br>
            <a href= "/delete1">記録削除</a>
            <p>：記録を削除できます</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-nav-link :href="route('logout')" :active="request()->routeIs('logput')" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('ログアウト') }}
                </x-nav-link>
            </form>
            <a href="/week">week</a>
            <!--<a href="/week">post</a>-->
        </p>
        @endsection
    </body>

</html>
