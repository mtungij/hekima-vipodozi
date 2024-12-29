<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'logo',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function paymentMethods(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

}
