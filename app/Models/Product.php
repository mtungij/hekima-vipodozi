<?php

namespace App\Models;

use App\Models\Scopes\BranchScope;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[ObservedBy(ProductObserver::class)]
// #[ScopedBy(BranchScope::class)]
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'company_id',
        'product_id',
        'name',
        'buy_price',
        'sale_price',
        'whole_price',
        'stock',
        'stock_alert',
        'whole_stock',
        'transport',
        'expire_date',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $name): string => Str::title($name),
            set: fn (string $name): string => strtolower($name),
        );
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function stockTransferItems(): HasMany
    {
        return $this->hasMany(StockTransferItem::class);
    }

    public function newStockItems(): HasMany
    {
        return $this->hasMany(NewStockItem::class);
    }

    public function damageProducts(): HasMany
    {
        return $this->hasMany(DamageProduct::class);
    }
}
