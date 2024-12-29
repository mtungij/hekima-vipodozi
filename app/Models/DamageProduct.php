<?php

namespace App\Models;

use App\Models\Scopes\BranchScope;
use App\Observers\DamageObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy(DamageObserver::class)]
#[ScopedBy(BranchScope::class)]
class DamageProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'user_id',
        'product_id',
        'amount',
        'desc',
    ];

     public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
