<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Warehouse Model - Matches Class Diagram Requirements
 * 
 * Fields according to class diagram:
 * - id : bigint (primary key, auto-increment)
 * - name : string (required)
 * - location : string (required)
 * - created_at : timestamp (auto-managed by Laravel)
 * - updated_at : timestamp (auto-managed by Laravel)
 */
class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
    ];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Validation rules for Warehouse model
     */
    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ];
    }

    /**
     * Validation rules for updating Warehouse
     */
    public static function updateRules($id)
    {
        return [
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ];
    }

    /**
     * Get the inventory records for the warehouse.
     */
    public function inventory(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }

    /**
     * Get the stock movements for the warehouse.
     */
    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    /**
     * Get all products in this warehouse
     */
    public function getProducts()
    {
        return $this->inventory()->with('product')->get()->pluck('product');
    }

    /**
     * Get inventories for this warehouse
     */
    public function getInventories()
    {
        return $this->inventory;
    }
}
