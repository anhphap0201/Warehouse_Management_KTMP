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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();                                                    // bigint
            $table->foreignId('product_id')->constrained()->onDelete('cascade');   // bigint
            $table->foreignId('warehouse_id')->constrained()->onDelete('cascade'); // bigint
            $table->enum('type', ['IN', 'OUT']);                           // enum [IN, OUT]
            $table->integer('quantity');                                   // int
            $table->timestamp('date');                                     // timestamp
            $table->string('reference_note')->nullable();                  // string
            $table->timestamps();                                          // created_at, updated_at
            
            // Index cho performance
            $table->index(['product_id', 'warehouse_id']);
            $table->index(['type', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
