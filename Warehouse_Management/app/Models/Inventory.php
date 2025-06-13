<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Inventory Model - Matches Class Diagram Requirements
 * 
 * Fields according to class diagram:
 * - id : bigint (primary key, auto-increment)
 * - product_id : bigint (foreign key to products table)
 * - warehouse_id : bigint (foreign key to warehouses table)
 * - quantity : int
 * - created_at : timestamp (auto-managed by Laravel)
 * - updated_at : timestamp (auto-managed by Laravel)
 */
class Inventory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'inventory';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'product_id',
        'warehouse_id',
        'quantity',
    ];

    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'warehouse_id' => 'integer',
        'quantity' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Validation rules for Inventory model
     */
    public static function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'quantity' => 'required|integer|min:0',
        ];
    }

    /**
     * Get the product that owns the inventory.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the warehouse that owns the inventory.
     */
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Adjust inventory quantity
     */
    public function adjustQuantity(int $delta): void
    {
        $this->quantity += $delta;
        $this->save();
    }

    /**
     * Get current quantity
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * Transfer stock to store
     */
    public function transferToStore(int $quantity): bool
    {
        if ($this->quantity >= $quantity) {
            $this->quantity -= $quantity;
            $this->save();
            
            // Record stock movement
            StockMovement::create([
                'product_id' => $this->product_id,
                'warehouse_id' => $this->warehouse_id,
                'type' => 'OUT',
                'quantity' => $quantity,
                'date' => now(),
                'reference_note' => 'Transfer to store'
            ]);
            
            return true;
        }
        
        return false;
    }
}
