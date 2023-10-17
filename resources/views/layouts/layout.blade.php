<!doctype html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Hello, world!</title>
   <nav class="navbar navbar-expand-lg navbar-light bg-light mt-0 mb-3">
        　　<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex" >
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>
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
</nav>
 </head>
 <body>
     @yield('content')
　</body>
</html>
