<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Scopes\CompanyScope;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// #[ScopedBy(CompanyScope::class)]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'branch_id',
        'name',
        'email',
        'phone',
        'isAdmin',
        'role',
        'avatar',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function cartItems(): HasManyThrough
    {
        return $this->hasManyThrough(CartItem::class, Cart::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function orderItems(): HasManyThrough
    {
        return $this->hasManyThrough(OrderItem::class, Order::class);
    }

    public function creditSaleReturns(): HasMany
    {
        return $this->hasMany(CreditSaleReturn::class, 'receiver_id');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function expenseItems(): HasManyThrough
    {
        return $this->hasManyThrough(ExpenseItem::class, Expense::class);
    }

    public function stockTransfer(): HasOne
    {
        return $this->hasOne(StockTransfer::class);
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
