<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warehouse extends Model
{
    use HasFactory;    protected $fillable = [
        'name',
        'code',
        'location',
        'address',
        'manager',
        'phone',
        'email',
        'capacity',
        'status',
        'description',
    ];

    /**
     * Lấy các bản ghi tồn kho cho kho hàng.
     */
    public function inventory(): HasMany
    {
        return $this->hasMany(Inventory:: class);
    }
}
