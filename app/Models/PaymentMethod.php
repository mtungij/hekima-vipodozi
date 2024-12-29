<?php

namespace App\Models;

use App\Models\Scopes\CompanyBranchesScope;
use App\Models\Scopes\CompanyScope;
use App\Observers\PaymentMethodObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy([PaymentMethodObserver::class])]
#[ScopedBy(CompanyBranchesScope::class)]
class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'number',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }
}
