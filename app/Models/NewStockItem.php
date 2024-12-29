<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewStockItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'new_stock_id',
        'product_id',
        'stock',
    ];

    public function newStock(): BelongsTo
    {
        return $this->belongsTo(NewStock::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
