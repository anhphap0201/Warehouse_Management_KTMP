# Hệ thống Layout Chuẩn - Warehouse Management

Tài liệu này mô tả hệ thống layout đã được chuẩn hóa để đảm bảo tính nhất quán giữa các trang trong dự án.

## Cấu trúc Layout Chuẩn

### 1. Header Types

#### Standard Header (Cho hầu hết các trang)
```blade
<div class="page-header-standard">
    <div class="page-header-content">
        <div class="page-title-section">
            <h1 class="page-title-main text-gray-900">
                <div class="page-title-icon simple-bg">
                    <i class="fas fa-icon text-color-600 text-lg"></i>
                </div>
                Tiêu đề trang
            </h1>
            <p class="page-subtitle">Mô tả ngắn gọn về trang</p>
        </div>
        <div class="page-actions">
            <a href="#" class="btn-primary-standard">
                <i class="fas fa-plus mr-2"></i>
                Thêm mới
            </a>
        </div>
    </div>
</div>
```

#### Gradient Header (Cho các trang đặc biệt)
```blade
<div class="page-header-gradient">
    <div class="page-header-content">
        <div class="page-title-section">
            <h1 class="page-title-main text-white">
                <div class="page-title-icon gradient-bg">
                    <i class="fas fa-icon text-white text-xl"></i>
                </div>
                Tiêu đề trang
            </h1>
            <p class="page-subtitle gradient-text">Mô tả ngắn gọn về trang</p>
        </div>
        <div class="page-actions">
            <a href="#" class="btn-primary-gradient">
                <i class="fas fa-plus mr-2"></i>
                Thêm mới
            </a>
        </div>
    </div>
</div>
```

### 2. Container Structure

```blade
<div class="page-container">
    <div class="page-content">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="flash-success mb-6">
                <div class="flash-content">
                    <i class="fas fa-check-circle flash-icon success"></i>
                    <span class="flash-text success">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="flash-error mb-6">
                <div class="flash-content">
                    <i class="fas fa-exclamation-circle flash-icon error"></i>
                    <span class="flash-text error">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- Content Area -->
        <!-- Your content here -->
    </div>
</div>
```

### 3. Card Layouts

#### Table Container
```blade
<div class="table-container">
    <div class="table-header">
        <h3 class="content-card-title">
            <i class="fas fa-list mr-3 text-blue-600"></i>
            Tiêu đề bảng
        </h3>
        <p class="content-card-subtitle">Mô tả về bảng dữ liệu</p>
    </div>
    <div class="table-wrapper">
        <!-- Table content -->
    </div>
</div>
```

#### Content Card
```blade
<div class="content-card">
    <div class="content-card-header">
        <h3 class="content-card-title">
            <i class="fas fa-icon mr-3 text-color-600"></i>
            Tiêu đề card
        </h3>
        <p class="content-card-subtitle">Mô tả về card</p>
    </div>
    <div class="content-card-body">
        <!-- Card content -->
    </div>
</div>
```

### 4. Grid Layouts

#### Stats Grid (4 cột)
```blade
<div class="stats-grid">
    <div class="stats-card">
        <!-- Stats content -->
    </div>
    <!-- More stats cards -->
</div>
```

#### Content Grid (3 cột)
```blade
<div class="content-grid">
    <div class="content-card">
        <!-- Card content -->
    </div>
    <!-- More cards -->
</div>
```

#### Actions Grid (3 cột)
```blade
<div class="actions-grid">
    <div class="content-card">
        <!-- Action card content -->
    </div>
    <!-- More action cards -->
</div>
```

### 5. Button Styles

#### Primary Buttons
```blade
<!-- Standard primary button -->
<a href="#" class="btn-primary-standard">
    <i class="fas fa-icon mr-2"></i>
    Button Text
</a>

<!-- Gradient primary button (for gradient headers) -->
<a href="#" class="btn-primary-gradient">
    <i class="fas fa-icon mr-2"></i>
    Button Text
</a>

<!-- Secondary button -->
<a href="#" class="btn-secondary-standard">
    <i class="fas fa-icon mr-2"></i>
    Button Text
</a>
```

### 6. Flash Messages

```blade
<!-- Success message -->
<div class="flash-success mb-6">
    <div class="flash-content">
        <i class="fas fa-check-circle flash-icon success"></i>
        <span class="flash-text success">Success message</span>
    </div>
</div>

<!-- Error message -->
<div class="flash-error mb-6">
    <div class="flash-content">
        <i class="fas fa-exclamation-circle flash-icon error"></i>
        <span class="flash-text error">Error message</span>
    </div>
</div>
```

## Component Usage với Page Layout

Sử dụng component `<x-page-layout>` để tạo trang mới:

```blade
<x-page-layout 
    title="Quản lý Sản phẩm"
    subtitle="Quản lý danh sách sản phẩm và thông tin chi tiết"
    icon="fas fa-box"
    iconColor="blue-600"
    :gradient="false"
    actionText="Thêm Sản phẩm"
    actionRoute="{{ route('products.create') }}"
    actionIcon="fas fa-plus">
    
    <!-- Your page content here -->
    
</x-page-layout>
```

### Props của Page Layout:

- `title`: Tiêu đề trang (bắt buộc)
- `subtitle`: Mô tả ngắn (tùy chọn)
- `icon`: FontAwesome icon class (bắt buộc)
- `iconColor`: Màu của icon cho header standard (mặc định: blue-600)
- `gradient`: true/false cho gradient header (mặc định: false)
- `actionText`: Text của button hành động (tùy chọn)
- `actionRoute`: Route của button hành động (tùy chọn)
- `actionIcon`: Icon của button hành động (mặc định: fas fa-plus)

## Màu sắc Icon theo Module

- **Dashboard**: `text-blue-600` (fas fa-tachometer-alt)
- **Products**: `text-blue-600` (fas fa-box)
- **Categories**: `text-green-600` (fas fa-tags)
- **Warehouses**: `text-blue-600` (fas fa-warehouse) - có thể dùng gradient
- **Stores**: `text-blue-600` (fas fa-store)
- **Suppliers**: `text-orange-600` (fas fa-truck)
- **Purchase Orders**: `text-purple-600` (fas fa-shopping-cart)

## Responsive Design

Tất cả components đều hỗ trợ responsive design:

- **Mobile**: Đơn giản hóa layout, giảm padding/margin
- **Tablet**: Layout 2 cột cho grid
- **Desktop**: Layout đầy đủ với tất cả các cột

## Legacy Support

Các class cũ vẫn được hỗ trợ để tương thích ngược:
- `.page-title` → sử dụng `.page-title-main`
- `.page-subtitle` → giữ nguyên
- `.btn-add-new` → tự động map sang `.btn-primary-standard`
- `.alert-success`, `.alert-error` → tự động styled

## Best Practices

1. **Luôn sử dụng page-container và page-content** cho layout wrapper
2. **Sử dụng gradient header** chỉ cho các trang đặc biệt (như Warehouses)
3. **Đặt flash messages** ngay sau page-content
4. **Sử dụng consistent icon colors** theo module
5. **Test responsive** trên các kích thước màn hình khác nhau
6. **Sử dụng semantic HTML** trong content areas

## Migration từ Layout cũ

1. Thay đổi header structure theo template mới
2. Wrap content trong `page-container` và `page-content`
3. Cập nhật flash messages sang format mới
4. Sử dụng card components cho tables và content
5. Cập nhật button classes sang primary/secondary standard

## Ví dụ Complete Page

```blade
<x-app-layout>
    <x-slot name="header">
        <div class="page-header-standard">
            <div class="page-header-content">
                <div class="page-title-section">
                    <h1 class="page-title-main text-gray-900">
                        <div class="page-title-icon simple-bg">
                            <i class="fas fa-box text-blue-600 text-lg"></i>
                        </div>
                        Quản lý Sản phẩm
                    </h1>
                    <p class="page-subtitle">Quản lý danh sách sản phẩm và thông tin chi tiết</p>
                </div>
                <div class="page-actions">
                    <a href="{{ route('products.create') }}" class="btn-primary-standard">
                        <i class="fas fa-plus mr-2"></i>
                        Thêm Sản phẩm
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="page-container">
        <div class="page-content">
            @if(session('success'))
                <div class="flash-success mb-6">
                    <div class="flash-content">
                        <i class="fas fa-check-circle flash-icon success"></i>
                        <span class="flash-text success">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="table-container">
                <div class="table-header">
                    <h3 class="content-card-title">
                        <i class="fas fa-list mr-3 text-blue-600"></i>
                        Danh sách sản phẩm
                    </h3>
                    <p class="content-card-subtitle">Tất cả sản phẩm được quản lý trong hệ thống</p>
                </div>
                <div class="table-wrapper">
                    <!-- Table content -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
```
