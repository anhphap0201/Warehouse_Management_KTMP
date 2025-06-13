<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Check if columns exist before dropping them
            $columns = Schema::getColumnListing('products');
            
            // Remove fields not in class diagram (but keep status first as it's used in indexes)
            if (in_array('price', $columns)) {
                $table->dropColumn('price');
            }
            if (in_array('brand', $columns)) {
                $table->dropColumn('brand');
            }
            if (in_array('barcode', $columns)) {
                $table->dropIndex('products_barcode_unique');
                $table->dropColumn('barcode');
            }
            if (in_array('min_stock_level', $columns)) {
                $table->dropColumn('min_stock_level');
            }
            if (in_array('max_stock_level', $columns)) {
                $table->dropColumn('max_stock_level');
            }
            if (in_array('image', $columns)) {
                $table->dropColumn('image');
            }
            if (in_array('attributes', $columns)) {
                $table->dropColumn('attributes');
            }
        });
        
        // Drop indexes that include status column separately
        if (Schema::hasColumn('products', 'status')) {
            Schema::table('products', function (Blueprint $table) {
                try {
                    $table->dropIndex('products_sku_status_index');
                } catch (Exception $e) {
                    // Index might not exist
                }
                
                // Remove status column last
                $table->dropColumn('status');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Restore removed columns
            $table->decimal('price', 15, 2)->nullable();
            $table->string('brand')->nullable();
            $table->string('barcode')->unique()->nullable();
            $table->integer('min_stock_level')->default(0);
            $table->integer('max_stock_level')->nullable();
            $table->boolean('status')->default(true);
            $table->string('image')->nullable();
            $table->json('attributes')->nullable();
            
            // Restore indexes
            $table->index(['category_id', 'status']);
            $table->index(['sku', 'status']);
        });
    }
};
