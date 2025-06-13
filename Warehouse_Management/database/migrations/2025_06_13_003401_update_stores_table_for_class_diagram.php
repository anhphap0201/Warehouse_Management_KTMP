<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Chỉ đảm bảo các trường theo class diagram không null
        // Giữ lại các trường khác để tương thích với code hiện có
        DB::statement('ALTER TABLE stores MODIFY COLUMN name VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE stores MODIFY COLUMN location VARCHAR(255) NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Khôi phục về nullable
        DB::statement('ALTER TABLE stores MODIFY COLUMN name VARCHAR(255) NULL');
        DB::statement('ALTER TABLE stores MODIFY COLUMN location VARCHAR(255) NULL');
    }
};
