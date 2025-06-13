<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Các thuộc tính có thể gán hàng loạt.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Các thuộc tính sẽ bị ẩn khi serialize.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Lấy các thuộc tính cần được chuyển đổi kiểu.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Create a new product
     */
    public function createProduct(array $productData): void
    {
        Product::create($productData);
    }

    /**
     * Get a product by ID
     */
    public function getProduct(int $productId): ?Product
    {
        return Product::find($productId);
    }

    /**
     * Update a product
     */
    public function updateProduct(int $productId, array $data): void
    {
        $product = Product::find($productId);
        if ($product) {
            $product->update($data);
        }
    }

    /**
     * Delete a product
     */
    public function deleteProduct(int $productId): void
    {
        $product = Product::find($productId);
        if ($product) {
            $product->delete();
        }
    }

    /**
     * Get all warehouses
     */
    public function getWarehouses(): \Illuminate\Database\Eloquent\Collection
    {
        return Warehouse::all();
    }

    /**
     * Transfer product to store
     */
    public function transferToStore(int $productId, int $warehouseId, int $quantity): bool
    {
        $inventory = Inventory::where([
            'product_id' => $productId,
            'warehouse_id' => $warehouseId
        ])->first();

        if ($inventory && $inventory->quantity >= $quantity) {
            return $inventory->transferToStore($quantity);
        }

        return false;
    }
}
