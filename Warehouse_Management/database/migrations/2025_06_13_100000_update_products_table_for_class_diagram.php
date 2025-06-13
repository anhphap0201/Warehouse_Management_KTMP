<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Cập nhật các trường trong products table để match với class diagram
        // Các trường id, created_at, updated_at đã được tạo sẵn bởi Laravel
        // Chỉ cần đảm bảo các trường khác không null (trừ description)
        DB::statement('ALTER TABLE products MODIFY COLUMN name VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE products MODIFY COLUMN sku VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE products MODIFY COLUMN unit VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE products MODIFY COLUMN description TEXT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Khôi phục về trạng thái cũ
        DB::statement('ALTER TABLE products MODIFY COLUMN name VARCHAR(255) NULL');
        DB::statement('ALTER TABLE products MODIFY COLUMN sku VARCHAR(255) NULL');
        DB::statement('ALTER TABLE products MODIFY COLUMN unit VARCHAR(255) NULL');
    }
};
