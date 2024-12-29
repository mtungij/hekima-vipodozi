<?php

namespace App\Observers;
use App\Models\Product;

class ProductObserver
{
    public function creating(Product $product): void
    {
        if(!$product->branch_id)
            $product->branch_id = auth()->user()->branch_id;
    }
}
