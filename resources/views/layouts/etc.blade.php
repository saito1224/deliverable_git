<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    
             <!-- Navigation Links -->
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
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- ... その他のコード ... -->
    </div>
</nav>
