<x-app-layout>    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Quản lý Cửa hàng') }}
            </h2>
            <a href="{{ route('stores.create') }}" 
               class="btn-add-new inline-flex items-center px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 shadow-md hover:shadow-lg touch-target">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Thêm Cửa hàng Mới
            </a>
        </div>
    </x-slot>

    <div class="py-4 sm:py-6">
        <div class="container-modern">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 text-gray-900 dark:text-gray-100">
                    @if($stores->count() > 0)
                        <!-- Stores Table -->
                        <x-table 
                            :headers="['Tên Cửa hàng', 'Địa chỉ', 'Số điện thoại', 'Quản lý', 'Trạng thái', 'Hành động']"
                            :mobileCards="true"
                            class="min-w-full">
                            @foreach($stores as $store)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap" data-label="Tên Cửa hàng">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $store->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap" data-label="Địa chỉ">
                                        <div class="text-sm text-gray-900 dark:text-gray-100">
                                            {{ $store->location ?? 'Chưa có địa chỉ' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap" data-label="Số điện thoại">
                                        <div class="text-sm text-gray-900 dark:text-gray-100">
                                            {{ $store->phone ?? 'Chưa có SĐT' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap" data-label="Quản lý">
                                        <div class="text-sm text-gray-900 dark:text-gray-100">
                                            {{ $store->manager ?? 'Chưa có quản lý' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap" data-label="Trạng thái">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $store->status ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' }}">
                                            {{ $store->status ? 'Hoạt động' : 'Ngừng hoạt động' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Hành động">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('stores.show', $store) }}" 
                                               class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 touch-target"
                                               title="Xem chi tiết">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('stores.edit', $store) }}" 
                                               class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300 touch-target"
                                               title="Chỉnh sửa">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('stores.destroy', $store) }}" method="POST" 
                                                  class="inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa cửa hàng này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 touch-target"
                                                        title="Xóa">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </x-table>
                        
                        <!-- Pagination -->
                        @if($stores->hasPages())
                            <div class="mt-6">
                                {{ $stores->links() }}
                            </div>
                        @endif
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12">
                            <div class="flex flex-col items-center justify-center space-y-4">
                                <svg class="w-16 h-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <div class="text-gray-500 dark:text-gray-400">
                                    <p class="text-lg font-medium">Chưa có cửa hàng nào</p>
                                    <p class="text-sm">Hãy thêm cửa hàng đầu tiên của bạn</p>
                                </div>
                                <a href="{{ route('stores.create') }}" 
                                   class="btn-add-new inline-flex items-center px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 shadow-md hover:shadow-lg touch-target">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Thêm Cửa hàng Mới
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>        </div>
    </div>
</x-app-layout>
