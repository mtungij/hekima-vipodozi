<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}
