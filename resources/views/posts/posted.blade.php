<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        @extends('layouts.common')

    </head>
    <body>
        @section('content')
        <h1>投稿完了</h1>
    　  <a href="{{ route('front') }}">トップへ</a>
        @endsection
    </body>
</html>