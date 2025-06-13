<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="page-title flex items-center">
                    <i class="fas fa-tachometer-alt mr-3 text-blue-600"></i>
                    {{ __('app.dashboard') }}
                </h1>
                <p class="page-subtitle">Tổng quan hệ thống quản lý kho hàng</p>
            </div>
            <div class="text-sm text-gray-500">
                Cập nhật: {{ now()->format('d/m/Y H:i') }}
            </div>
        </div>
    </x-slot>

    <!-- Modern Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Products Stats Card -->
        <div class="stats-card">
            <div class="flex items-center justify-between">
                <div>
                    <div class="stats-card-icon bg-blue-600">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="stats-card-value">{{ App\Models\Product::count() }}</div>
                    <div class="stats-card-label">Tổng số sản phẩm</div>
                </div>
                <div class="text-right">
                    <div class="text-xs text-green-600 font-medium">
                        <i class="fas fa-arrow-up mr-1"></i>+12%
                    </div>
                    <div class="text-xs text-gray-500">vs tháng trước</div>
                </div>
            </div>
        </div>

        <!-- Categories Stats Card -->
        <div class="stats-card">
            <div class="flex items-center justify-between">
                <div>
                    <div class="stats-card-icon bg-green-600">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="stats-card-value">{{ App\Models\Category::count() }}</div>
                    <div class="stats-card-label">Danh mục sản phẩm</div>
                </div>
                <div class="text-right">
                    <div class="text-xs text-green-600 font-medium">
                        <i class="fas fa-arrow-up mr-1"></i>+5%
                    </div>
                    <div class="text-xs text-gray-500">vs tháng trước</div>
                </div>
            </div>
        </div>

        <!-- Warehouses Stats Card -->
        <div class="stats-card">
            <div class="flex items-center justify-between">
                <div>
                    <div class="stats-card-icon bg-purple-600">
                        <i class="fas fa-warehouse"></i>
                    </div>
                    <div class="stats-card-value">{{ App\Models\Warehouse::count() }}</div>
                    <div class="stats-card-label">Kho hàng</div>
                </div>
                <div class="text-right">
                    <div class="text-xs text-blue-600 font-medium">
                        <i class="fas fa-minus mr-1"></i>Ổn định
                    </div>
                    <div class="text-xs text-gray-500">không đổi</div>
                </div>
            </div>
        <!-- Stores Stats Card -->
        <div class="stats-card">
            <div class="flex items-center justify-between">
                <div>
                    <div class="stats-card-icon bg-orange-600">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="stats-card-value">{{ App\Models\Store::count() }}</div>
                    <div class="stats-card-label">Cửa hàng</div>
                </div>
                <div class="text-right">
                    <div class="text-xs text-green-600 font-medium">
                        <i class="fas fa-arrow-up mr-1"></i>+8%
                    </div>
                    <div class="text-xs text-gray-500">vs tháng trước</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Product Management Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-box mr-2 text-blue-600"></i>
                    Quản lý sản phẩm
                </h3>
            </div>
            <div class="card-body">
                <p class="text-gray-600 text-sm mb-4">Quản lý danh sách sản phẩm và danh mục</p>
                <div class="space-y-2">
                    <a href="{{ route('products.index') }}" class="btn btn-primary w-full">
                        <i class="fas fa-list mr-2"></i>
                        Xem sản phẩm
                    </a>
                    <a href="{{ route('products.create') }}" class="btn btn-outline w-full">
                        <i class="fas fa-plus mr-2"></i>
                        Thêm sản phẩm
                    </a>
                </div>
            </div>
        </div>

        <!-- Warehouse Management Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-warehouse mr-2 text-purple-600"></i>
                    Quản lý kho
                </h3>
            </div>
            <div class="card-body">
                <p class="text-gray-600 text-sm mb-4">Quản lý kho hàng và tồn kho</p>
                <div class="space-y-2">
                    <a href="{{ route('warehouses.index') }}" class="btn btn-primary w-full">
                        <i class="fas fa-list mr-2"></i>
                        Xem kho hàng
                    </a>
                    <a href="{{ route('warehouses.create') }}" class="btn btn-outline w-full">
                        <i class="fas fa-plus mr-2"></i>
                        Thêm kho
                    </a>
                </div>
            </div>
        </div>

        <!-- Purchase Orders Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-shopping-cart mr-2 text-green-600"></i>
                    Nhập hàng
                </h3>
            </div>
            <div class="card-body">
                <p class="text-gray-600 text-sm mb-4">Quản lý đơn hàng nhập kho</p>
                <div class="space-y-2">
                    <a href="{{ route('purchase-orders.index') }}" class="btn btn-primary w-full">
                        <i class="fas fa-list mr-2"></i>
                        Xem đơn nhập
                    </a>
                    <a href="{{ route('purchase-orders.create') }}" class="btn btn-outline w-full">
                        <i class="fas fa-plus mr-2"></i>
                        Tạo đơn nhập
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Analytics -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Products -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-clock mr-2 text-blue-600"></i>
                    Sản phẩm mới nhất
                </h3>
            </div>
            <div class="card-body">
                @if(App\Models\Product::count() > 0)
                    <div class="space-y-3">
                        @foreach(App\Models\Product::latest()->take(5)->get() as $product)
                            <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gray-200 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-box text-gray-600 text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 text-sm">{{ $product->name }}</p>
                                        <p class="text-gray-500 text-xs">SKU: {{ $product->sku }}</p>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500">{{ $product->created_at->diffForHumans() }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('products.index') }}" class="text-blue-600 text-sm font-medium hover:text-blue-700">
                            Xem tất cả →
                        </a>
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-box text-gray-300 text-3xl mb-3"></i>
                        <p class="text-gray-500">Chưa có sản phẩm nào</p>
                        <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm mt-3">
                            Thêm sản phẩm đầu tiên
                        </a>
                    </div>
                @endif
            </div>
        </div>>
                
                <!-- Cột 1: Quản lý Kho Hàng -->
                <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-lg rounded-lg border border-gray-100 dark:border-slate-700">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-6">
                            <h3 class="text-xl font-semibold mb-4 flex items-center text-blue-600 dark:text-blue-400 border-b border-gray-200 dark:border-slate-700 pb-2">
                                <i class="fas fa-warehouse mr-2"></i>
                                {{ __('Quản lý Kho Hàng') }}
                            </h3>
                            
                            @if($warehouses->count() > 0)
                                <div class="space-y-3 mb-4">
                                    @foreach($warehouses as $warehouse)
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-semibold text-gray-900 dark:text-gray-100">
                                                    {{ $warehouse->name }}
                                                </h4>
                                                <p class="text-sm text-gray-500 dark:text-gray-300 mt-1">
                                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    {{ $warehouse->location ?? 'Chưa cập nhật' }}
                                                </p>
                                                <p class="text-xs text-gray-400 mt-1">
                                                    Tạo: {{ $warehouse->created_at->format('d/m/Y') }}
                                                </p>
                                            </div>
                                            <div class="flex space-x-2">
                                                <a href="{{ route('warehouses.show', $warehouse) }}" 
                                                   class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm">
                                                    Chi tiết
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                
                                <div class="flex justify-center">
                                    <a href="{{ route('warehouses.index') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                        </svg>
                                        Xem tất cả kho hàng
                                    </a>
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-full mb-3">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                    <h4 class="text-md font-medium text-gray-900 dark:text-gray-100 mb-2">
                                        Chưa có kho hàng nào
                                    </h4>
                                    <a href="{{ route('warehouses.index') }}" 
                                       class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md">
                                        Xem trang kho hàng
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Cột 2: Quản lý Cửa Hàng -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                {{ __('Quản lý Cửa Hàng') }}
                            </h3>
                            
                            @if($stores->count() > 0)
                                <div class="space-y-3 mb-4">
                                    @foreach($stores as $store)
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <div class="flex items-center">
                                                    <h4 class="font-semibold text-gray-900 dark:text-gray-100">
                                                        {{ $store->name }}
                                                    </h4>
                                                    <span class="ml-2 px-2 py-1 text-xs rounded-full {{ $store->status ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                                        {{ $store->status ? 'Hoạt động' : 'Tạm đóng' }}
                                                    </span>
                                                </div>
                                                <p class="text-sm text-gray-500 dark:text-gray-300 mt-1">
                                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    {{ $store->location ?? 'Chưa cập nhật' }}
                                                </p>
                                                @if($store->manager)
                                                <p class="text-sm text-gray-500 dark:text-gray-300 mt-1">
                                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>
                                                    QL: {{ $store->manager }}
                                                </p>
                                                @endif
                                                <p class="text-xs text-gray-400 mt-1">
                                                    Tạo: {{ $store->created_at->format('d/m/Y') }}
                                                </p>
                                            </div>
                                            <div class="flex space-x-2">
                                                <a href="{{ route('stores.show', $store) }}" 
                                                   class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300 text-sm">
                                                    Chi tiết
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                
                                <div class="flex justify-center">
                                    <a href="{{ route('stores.index') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                        </svg>
                                        Xem tất cả cửa hàng
                                    </a>
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-full mb-3">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <h4 class="text-md font-medium text-gray-900 dark:text-gray-100 mb-2">
                                        Chưa có cửa hàng nào
                                    </h4>
                                    <a href="{{ route('stores.index') }}" 
                                       class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md">
                                        Xem trang cửa hàng
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thông báo chào mừng -->
            <div class="mt-8 bg-blue-50 dark:bg-blue-900/20 rounded-lg p-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-medium text-blue-800 dark:text-blue-200">
                            Chào mừng đến với Hệ thống Quản lý Kho hàng
                        </h3>
                        <p class="mt-2 text-blue-700 dark:text-blue-300">
                            Bạn đã đăng nhập thành công! Sử dụng menu điều hướng để truy cập các chức năng quản lý kho hàng, cửa hàng và báo cáo.
                        </p>
                        <div class="mt-4">
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('warehouses.index') }}" class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                    Quản lý Kho
                                </a>
                                <a href="{{ route('stores.index') }}" class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    Quản lý Cửa hàng
                                </a>
                                <a href="{{ route('purchase-orders.index') }}" class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                    </svg>
                                    Hóa đơn nhập
                                </a>
                                <a href="{{ route('categories.index') }}" class="inline-flex items-center px-3 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-md transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    Quản lý Danh mục
                                </a>
                                <a href="{{ route('products.index') }}" class="inline-flex items-center px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                    Quản lý Sản phẩm
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
