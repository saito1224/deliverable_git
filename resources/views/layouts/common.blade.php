<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>活動計測</title>
        <link rel="stylesheet" href="{{ asset('cssLayout/common.css') }}">
>
    </head>
    <body class="custom-background">
            <div class="header">
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('front')" :active="request()->routeIs('front')">
                        {{ __('トップ') }}
                    </x-nav-link>
                    <x-nav-link :href="route('profile1')" :active="request()->routeIs('profile1')">
                        {{ __('プロフィール') }}
                    </x-nav-link>
                    <x-nav-link :href="route('recordset')" :active="request()->routeIs('precordset')">
                        {{ __('記録する') }}
                    </x-nav-link>
            </div>
           
            </div>
        @yield('content')
       
        
    </body>
</html>
