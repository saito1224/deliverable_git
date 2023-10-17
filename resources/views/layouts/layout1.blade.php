
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
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
   <div class="navbar-nav">
<a class="nav-item nav-link active" href="#">新規作成</a>
<a class="nav-item nav-link disabled" href="#">編集</a>
<a class="nav-item nav-link disabled" href="#">一覧表示</a>
</div>