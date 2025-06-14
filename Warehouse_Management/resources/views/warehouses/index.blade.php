<x-app-layout>    <x-slot name="header">
        <div class="page-header-standard">
            <div class="page-header-content">
                <div class="page-title-section">
                    <h1 class="page-title-main text-gray-900">
                        <div class="page-title-icon simple-bg">
                            <i class="fas fa-warehouse text-blue-600 text-lg"></i>
                        </div>
                        {{ __('Quản lý Kho Hàng') }}
                    </h1>
                    <p class="page-subtitle">
                        Quản lý và theo dõi tất cả các kho hàng trong hệ thống
                    </p>
                </div>
                <div class="page-actions">
                    <a href="{{ route('warehouses.create') }}" class="btn-primary-standard">
                        <i class="fas fa-plus mr-2"></i>
                        {{ __('Thêm Kho Mới') }}
                    </a>
                </div>
            </div>
        </div>
    </x-slot><div class="page-container">
        <div class="page-content">
            <!-- Success Message -->
            @if(session('success'))
                <div class="flash-success mb-8">
                    <div class="flash-content">
                        <i class="fas fa-check-circle flash-icon success"></i>
                        <span class="flash-text success">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Warehouses Grid -->
            <div class="content-card">
                <div class="content-card-header">
                    <h3 class="content-card-title">
                        <i class="fas fa-list mr-3 text-blue-600"></i>
                        Danh Sách Kho Hàng
                    </h3>
                    <p class="content-card-subtitle">Tất cả kho hàng được quản lý trong hệ thống</p>
                </div>

                <div class="content-card-body">                    @if($warehouses->count() > 0)                        <div class="content-grid">
                            @foreach($warehouses as $warehouse)
                                <div class="group bg-white hover:bg-blue-50 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-gray-200 hover:border-blue-300 overflow-hidden">
                                    <!-- Card Header -->
                                    <div class="p-6 bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <div class="bg-white bg-opacity-20 p-3 rounded-full mr-4">
                                                    <i class="fas fa-warehouse text-xl"></i>
                                                </div>
                                                <div>
                                                    <h3 class="text-xl font-bold">{{ $warehouse->name }}</h3>
                                                    <p class="text-blue-100 text-sm">ID: #{{ $warehouse->id }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    <!-- Card Body -->
                                    <div class="p-6 bg-white group-hover:bg-blue-50 transition-colors duration-300">
                                        @if($warehouse->location)
                                            <div class="flex items-center text-gray-600 mb-4">
                                                <i class="fas fa-map-marker-alt text-blue-600 mr-3"></i>
                                                <span class="text-sm">{{ $warehouse->location }}</span>
                                            </div>
                                        @endif

                                        <!-- Warehouse Stats -->
                                        <div class="grid grid-cols-2 gap-4 mb-6">
                                            <div class="bg-blue-50 group-hover:bg-blue-100 rounded-lg p-3 text-center transition-colors duration-300">
                                                <div class="text-2xl font-bold text-blue-600">
                                                    {{ $warehouse->inventory->count() }}
                                                </div>
                                                <div class="text-xs text-blue-600 font-medium">
                                                    Sản phẩm
                                                </div>
                                            </div>
                                            <div class="bg-purple-50 group-hover:bg-purple-100 rounded-lg p-3 text-center transition-colors duration-300">
                                                <div class="text-2xl font-bold text-purple-600">
                                                    {{ $warehouse->inventory->sum('quantity') }}
                                                </div>
                                                <div class="text-xs text-purple-600 font-medium">
                                                    Tổng số lượng
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                                            <i class="fas fa-calendar-alt mr-2"></i>
                                            Tạo: {{ $warehouse->created_at->format('d/m/Y H:i') }}
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="flex space-x-2">
                                            <a href="{{ route('warehouses.show', $warehouse) }}" 
                                               class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-all duration-300 transform hover:scale-105">
                                                <i class="fas fa-eye mr-2"></i>
                                                Xem
                                            </a>
                                            <a href="{{ route('warehouses.edit', $warehouse) }}" 
                                               class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-lg transition-all duration-300 transform hover:scale-105">
                                                <i class="fas fa-edit mr-2"></i>
                                                Sửa
                                            </a>
                                            <form method="POST" action="{{ route('warehouses.destroy', $warehouse) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition-all duration-300 transform hover:scale-105"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa kho này không?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $warehouses->links() }}
                        </div>
                    @else
                        <div class="text-center py-16">
                            <div class="mx-auto h-20 w-20 text-gray-400 mb-6">
                                <i class="fas fa-warehouse text-6xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Chưa có kho hàng nào</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-6">
                                Bắt đầu bằng cách tạo kho hàng đầu tiên của bạn.
                            </p>
                            <a href="{{ route('warehouses.create') }}" 
                               class="inline-flex items-center px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-lg transition-all duration-300 transform hover:scale-105">
                                <i class="fas fa-plus mr-2"></i>
                                Tạo Kho Hàng Đầu Tiên
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
