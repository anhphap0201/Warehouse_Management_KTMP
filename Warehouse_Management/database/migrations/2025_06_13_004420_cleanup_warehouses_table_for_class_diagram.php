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
        Schema::table('warehouses', function (Blueprint $table) {
            // Xóa các cột không cần thiết theo class diagram
            $table->dropColumn([
                'code',
                'address',
                'manager',
                'phone',
                'email',
                'capacity',
                'status',
                'description'
            ]);
        });

        // Đảm bảo các trường cốt lõi không null
        DB::statement('ALTER TABLE warehouses MODIFY COLUMN name VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE warehouses MODIFY COLUMN location VARCHAR(255) NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warehouses', function (Blueprint $table) {
            // Khôi phục lại các cột đã xóa
            $table->string('code')->nullable();
            $table->text('address')->nullable();
            $table->string('manager')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->decimal('capacity', 15, 2)->nullable();
            $table->boolean('status')->default(true);
            $table->text('description')->nullable();
        });
    }
};
