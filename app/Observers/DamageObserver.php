<?php

namespace App\Observers;
use App\Models\DamageProduct;

class DamageObserver
{
    public function creating(DamageProduct $damageProduct): void
    {
        $damageProduct->branch_id = auth()->user()->branch_id;
        $damageProduct->user_id = auth()->id();
    }
}
