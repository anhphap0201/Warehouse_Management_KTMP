<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">    <!-- Menu điều hướng chính -->
    <div class="container-70">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>                <!-- Liên kết điều hướng -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                        {{ __('Danh mục') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                        {{ __('Sản phẩm') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('warehouses.index')" :active="request()->routeIs('warehouses.*')">
                        {{ __('Kho hàng') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('stores.index')" :active="request()->routeIs('stores.*')">
                        {{ __('Cửa hàng') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('suppliers.index')" :active="request()->routeIs('suppliers.*')">
                        {{ __('Nhà cung cấp') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('purchase-orders.index')" :active="request()->routeIs('purchase-orders.*')">
                        {{ __('Nhập hàng') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('admin.auto-generation.index')" :active="request()->routeIs('admin.auto-generation.*')">
                        {{ __('Tự động tạo') }}
                    </x-nav-link>
                </div>
            </div>
            
            <!-- Menu thả xuống cài đặt -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-3">
                  <!-- Thông báo -->
                <div class="relative">
                    <a href="{{ route('notifications.index') }}"
                       class="relative inline-flex items-center justify-center p-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-150 ease-in-out {{ request()->routeIs('notifications.*') ? 'text-indigo-600 dark:text-indigo-400' : '' }}"
                       title="Thông báo">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5-5V7a6 6 0 10-12 0v5l-5 5h5m7 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        
                        <!-- Chấm thông báo/điểm -->
                        <span id="notificationDot" class="absolute -top-0.5 -right-0.5 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full min-w-[1.25rem] h-5 shadow-lg {{ $unreadNotificationsCount > 0 ? 'animate-pulse' : 'hidden' }}">
                            <span id="notificationCount">{{ $unreadNotificationsCount > 99 ? '99+' : $unreadNotificationsCount }}</span>
                        </span>
                    </a>
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Xác thực -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Menu hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>        </div>
    </div>    <!-- Menu điều hướng đáp ứng -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="container-70">
            <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                {{ __('Danh mục') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                {{ __('Sản phẩm') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('warehouses.index')" :active="request()->routeIs('warehouses.*')">
                {{ __('Kho hàng') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('stores.index')" :active="request()->routeIs('stores.*')">
                {{ __('Cửa hàng') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('suppliers.index')" :active="request()->routeIs('suppliers.*')">
                {{ __('Nhà cung cấp') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('purchase-orders.index')" :active="request()->routeIs('purchase-orders.*')">
                {{ __('Nhập hàng') }}
            </x-responsive-nav-link>
              <x-responsive-nav-link :href="route('admin.auto-generation.index')" :active="request()->routeIs('admin.auto-generation.*')">
                {{ __('Tự động tạo') }}
            </x-responsive-nav-link>
            </div>
            
            <!-- Tùy chọn cài đặt đáp ứng -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                
                <!-- Liên kết thông báo di động -->
                <x-responsive-nav-link :href="route('notifications.index')" :active="request()->routeIs('notifications.*')">
                    <div class="flex items-center justify-between">
                        <span>{{ __('Thông báo') }}</span>
                        <!-- Chấm thông báo di động -->
                        <span id="mobileNotificationDot" class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full min-w-[1.25rem] h-5 shadow-lg {{ $unreadNotificationsCount > 0 ? 'animate-pulse' : 'hidden' }}">
                            <span id="mobileNotificationCount">{{ $unreadNotificationsCount > 99 ? '99+' : $unreadNotificationsCount }}</span>
                        </span>
                    </div>
                </x-responsive-nav-link>
                
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Xác thực -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
