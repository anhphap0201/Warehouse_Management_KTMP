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
        Schema::table('inventory', function (Blueprint $table) {
            // Xóa các cột không cần thiết theo class diagram
            $table->dropColumn([
                'reserved_quantity',
                'min_stock_level',
                'max_stock_level',
                'average_cost',
                'last_movement_at',
                'notes'
            ]);
        });

        // Đảm bảo quantity không null và có giá trị mặc định
        DB::statement('ALTER TABLE inventory MODIFY COLUMN quantity INT NOT NULL DEFAULT 0');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventory', function (Blueprint $table) {
            // Khôi phục lại các cột đã xóa
            $table->integer('reserved_quantity')->default(0);
            $table->integer('min_stock_level')->default(0);
            $table->integer('max_stock_level')->nullable();
            $table->decimal('average_cost', 15, 2)->nullable();
            $table->timestamp('last_movement_at')->nullable();
            $table->text('notes')->nullable();
        });
    }
};
