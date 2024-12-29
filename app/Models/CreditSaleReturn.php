<?php

namespace App\Models;

use App\Observers\CreditSaleReturnObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy(CreditSaleReturnObserver::class)]
class CreditSaleReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'order_id',
        'payment_method_id',
        'receiver_id',
        'amount'
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
