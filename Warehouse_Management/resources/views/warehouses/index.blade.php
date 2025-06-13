<x-app-layout>    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-4 sm:space-y-0">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Quản lý Kho Hàng') }}
            </h2>
            <a href="{{ route('warehouses.create') }}" 
               class="btn-add-new touch-target inline-flex items-center justify-center px-4 py-2 text-sm font-medium rounded-md transition-colors w-full sm:w-auto">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                {{ __('Thêm Kho Mới') }}
            </a>
        </div>
    </x-slot><div class="py-4 sm:py-6">
        <div class="container-modern">
            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Warehouses Grid -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 text-gray-900 dark:text-gray-100">
                    @if($warehouses->count() > 0)
                        <div id="warehousesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($warehouses as $warehouse)
                                <div class="warehouse-card bg-gray-50 dark:bg-gray-700 rounded-lg p-6 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors border border-gray-200 dark:border-gray-600">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center mb-3">
                                                <svg class="w-8 h-8 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                                    {{ $warehouse->name }}
                                                </h3>
                                            </div>
                                            
                                            @if($warehouse->location)
                                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 mb-3">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    {{ $warehouse->location }}
                                                </div>
                                            @endif

                                            <!-- Warehouse Stats -->
                                            <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400 mb-4">
                                                <span class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                                    </svg>
                                                    {{ $warehouse->inventory->count() }} sản phẩm
                                                </span>
                                                <span class="text-xs">
                                                    {{ $warehouse->created_at->format('d/m/Y') }}
                                                </span>
                                            </div>                            <!-- Action Buttons -->
                            <div class="flex space-x-2">
                                <a href="{{ route('warehouses.show', $warehouse) }}" 
                                   class="action-btn-view touch-target flex-1 text-center py-2 px-3 rounded text-sm font-medium transition-colors">
                                    {{ __('Xem Chi Tiết') }}
                                </a>
                                <a href="{{ route('warehouses.edit', $warehouse) }}" 
                                   class="touch-target bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-3 rounded text-sm font-medium transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('warehouses.destroy', $warehouse) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa kho này?')"
                                            class="touch-target bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded text-sm font-medium transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                                        </div>
                                    </div>                                </div>
                            @endforeach
                        </div>

                        <!-- Empty Search State -->
                        <div id="emptySearchState" class="hidden text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Không tìm thấy kho hàng nào</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Không có kho hàng nào khớp với từ khóa tìm kiếm. Hãy thử từ khóa khác.</p>
                        </div>

                        <!-- Pagination -->
                        @if(method_exists($warehouses, 'links'))
                            <div class="mt-6">
                                {{ $warehouses->links() }}
                            </div>
                        @endif
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12">
                            <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <h3 class="mt-6 text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Chưa có kho hàng nào') }}</h3>
                            <p class="mt-2 text-gray-500 dark:text-gray-400">{{ __('Bắt đầu bằng cách tạo kho hàng đầu tiên của bạn.') }}</p>                            <div class="mt-6">
                                <a href="{{ route('warehouses.create') }}" 
                                   class="btn-add-new touch-target inline-flex items-center justify-center px-6 py-3 text-sm font-medium rounded-lg shadow-lg transform transition-all duration-200 hover:scale-105">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    {{ __('Thêm Kho Đầu Tiên') }}
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>        </div>
    </div>
</x-app-layout>
