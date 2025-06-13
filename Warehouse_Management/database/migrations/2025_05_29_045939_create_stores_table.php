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
        Schema::create('stores', function (Blueprint $table) {
            // Core fields according to class diagram
            $table->id();                              // bigint
            $table->string('name');                    // string (required)
            $table->string('location');                // string (required)
            $table->timestamps();                      // created_at, updated_at
            
            // Additional fields for extended functionality (backward compatibility)
            $table->string('code')->unique();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('manager')->nullable();
            $table->string('type')->default('branch'); // flagship, branch, outlet, etc.
            $table->decimal('area', 8, 2)->nullable(); // Diện tích m2
            $table->integer('capacity')->nullable(); // Sức chứa tối đa
            $table->boolean('status')->default(true);
            $table->text('description')->nullable();
            $table->json('operating_hours')->nullable(); // Giờ hoạt động
            
            // Index cho performance
            $table->index(['code', 'status']);
            $table->index(['type', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
