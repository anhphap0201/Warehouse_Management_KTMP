<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Store Model - Matches Class Diagram Requirements
 * 
 * Fields according to class diagram:
 * - id : bigint (primary key, auto-increment)
 * - name : string (required)
 * - location : string (required)
 * - created_at : timestamp (auto-managed by Laravel)
 * - updated_at : timestamp (auto-managed by Laravel)
 * 
 * Note: Additional fields are kept for backward compatibility with existing code
 */
class Store extends Model
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
     * Validation rules for Store model (class diagram fields)
     */
    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ];
    }

    /**
     * Validation rules for updating Store
     */
    public static function updateRules($id)
    {
        return [
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ];
    }    /**
     * Lấy các bản ghi tồn kho cửa hàng.
     */
    public function inventory(): HasMany
    {
        return $this->hasMany(StoreInventory::class);
    }

    /**
     * Lấy các thông báo cho cửa hàng này.
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }    /**
     * Lấy các thông báo đang chờ cho cửa hàng này.
     */
    public function pendingNotifications(): HasMany
    {
        return $this->hasMany(Notification::class)->where('status', 'pending');
    }

    /**
     * Kiểm tra xem cửa hàng có đang hoạt động không
     */
    public function isActive(): bool
    {
        return $this->status;
    }

    /**
     * Receive stock from warehouse
     */
    public function receiveStock(int $productId, int $quantity): bool
    {
        // Logic to receive stock from warehouse
        // This would typically involve updating store inventory
        // and creating appropriate stock movement records
        
        // For now, we'll create a stock movement record
        StockMovement::create([
            'product_id' => $productId,
            'warehouse_id' => 1, // Default warehouse, should be configurable
            'type' => 'OUT',
            'quantity' => $quantity,
            'date' => now(),
            'reference_note' => "Transfer to store: {$this->name}"
        ]);
        
        return true;
    }

    /**
     * Return stock to warehouse
     */
    public function returnStock(int $productId, int $quantity): bool
    {
        // Logic to return stock to warehouse
        // This would typically involve updating store inventory
        // and creating appropriate stock movement records
        
        StockMovement::create([
            'product_id' => $productId,
            'warehouse_id' => 1, // Default warehouse, should be configurable
            'type' => 'IN',
            'quantity' => $quantity,
            'date' => now(),
            'reference_note' => "Return from store: {$this->name}"
        ]);
        
        return true;
    }
}
