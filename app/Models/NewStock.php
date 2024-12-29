<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use App\Observers\NewStockObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(NewStockObserver::class)]
#[ScopedBy(CompanyScope::class)]
class NewStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'user_id', 
        'to_branch_id',
        'status'
    ];


    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function toBranch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'to_branch_id');
    }

    public function newStockItems(): HasMany
    {
        return $this->hasMany(NewStockItem::class);
    }
}
