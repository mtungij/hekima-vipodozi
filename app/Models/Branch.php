<?php

namespace App\Models;

use App\Models\Scopes\CompanyBranchesScope;
use App\Observers\BranchObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

// #[ObservedBy([BranchObserver::class])]
#[ScopedBy([CompanyBranchesScope::class])]
class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'address',
        'phone',
        'taxt_id'
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $name): string => strtoupper($name),
            set: fn (string $name): string => strtolower($name),
        );
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

    public function creditSaleReturns(): HasMany
    {
        return $this->hasMany(CreditSaleReturn::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function stockTransfers(): HasMany
    {
        return $this->hasMany(StockTransfer::class);
    }

    public function newStocks(): HasMany
    {
        return $this->hasMany(NewStock::class);
    }

    public function damageProducts(): HasMany
    {
        return $this->hasMany(DamageProduct::class);
    }
}
