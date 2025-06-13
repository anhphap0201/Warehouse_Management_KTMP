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
        Schema::table('stores', function (Blueprint $table) {
            // Check if columns exist before dropping them
            $columns = Schema::getColumnListing('stores');
            
            // Drop indexes first
            if (in_array('code', $columns)) {
                $table->dropIndex('stores_code_unique');
                $table->dropIndex('stores_code_status_index');
            }
            if (in_array('type', $columns) && in_array('status', $columns)) {
                $table->dropIndex('stores_type_status_index');
            }
            
            // Remove fields not in class diagram
            if (in_array('code', $columns)) {
                $table->dropColumn('code');
            }
            if (in_array('address', $columns)) {
                $table->dropColumn('address');
            }
            if (in_array('phone', $columns)) {
                $table->dropColumn('phone');
            }
            if (in_array('email', $columns)) {
                $table->dropColumn('email');
            }
            if (in_array('manager', $columns)) {
                $table->dropColumn('manager');
            }
            if (in_array('type', $columns)) {
                $table->dropColumn('type');
            }
            if (in_array('area', $columns)) {
                $table->dropColumn('area');
            }
            if (in_array('capacity', $columns)) {
                $table->dropColumn('capacity');
            }
            if (in_array('status', $columns)) {
                $table->dropColumn('status');
            }
            if (in_array('description', $columns)) {
                $table->dropColumn('description');
            }
            if (in_array('operating_hours', $columns)) {
                $table->dropColumn('operating_hours');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            // Restore removed columns
            $table->string('code')->unique();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('manager')->nullable();
            $table->string('type')->default('branch');
            $table->decimal('area', 8, 2)->nullable();
            $table->integer('capacity')->nullable();
            $table->boolean('status')->default(true);
            $table->text('description')->nullable();
            $table->json('operating_hours')->nullable();
            
            // Restore indexes
            $table->index(['code', 'status']);
            $table->index(['type', 'status']);
        });
    }
};
