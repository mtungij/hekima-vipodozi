<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use App\Observers\OrderObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ScopedBy(CompanyScope::class)]
#[ObservedBy(OrderObserver::class)]
class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'branch_id',
        'customer_id',
        'payment_method_id',
        'vendor_id',
        'sale_date',
        'due_date',
        'status',
        'transportFee',
    ];

    protected function casts(): array
    {
        return [
            'transportFee' => 'boolean',
        ];
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function creditSaleReturns(): HasMany
    {
        return $this->hasMany(CreditSaleReturn::class);
    }
}
