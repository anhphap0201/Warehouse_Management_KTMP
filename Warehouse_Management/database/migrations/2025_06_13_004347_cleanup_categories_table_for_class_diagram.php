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
        Schema::table('categories', function (Blueprint $table) {
            // Check if parent_id column exists before dropping foreign key
            $columns = Schema::getColumnListing('categories');
            if (in_array('parent_id', $columns)) {
                // Try to drop foreign key constraint safely
                try {
                    $table->dropForeign(['parent_id']);
                } catch (\Illuminate\Database\QueryException $e) {
                    // Foreign key might not exist or have different name
                    // Try to find and drop any foreign key constraints on parent_id
                    $foreignKeys = DB::select("SELECT CONSTRAINT_NAME 
                                               FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
                                               WHERE TABLE_NAME = 'categories' 
                                               AND COLUMN_NAME = 'parent_id' 
                                               AND CONSTRAINT_NAME != 'PRIMARY'");
                    
                    foreach ($foreignKeys as $fk) {
                        DB::statement("ALTER TABLE categories DROP FOREIGN KEY {$fk->CONSTRAINT_NAME}");
                    }
                }
            }
            
            // Xóa các cột không cần thiết theo class diagram
            if (in_array('slug', $columns)) {
                $table->dropColumn('slug');
            }
            if (in_array('description', $columns)) {
                $table->dropColumn('description');
            }
            if (in_array('parent_id', $columns)) {
                $table->dropColumn('parent_id');
            }
        });

        // Đảm bảo name không null
        DB::statement('ALTER TABLE categories MODIFY COLUMN name VARCHAR(255) NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            // Khôi phục lại các cột đã xóa
            $table->string('slug')->unique()->nullable();
            $table->text('description')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade');
        });
    }
};
