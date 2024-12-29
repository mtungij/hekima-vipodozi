<?php

namespace App\Observers;
use App\Models\NewStock;

class NewStockObserver
{
    public function creating(NewStock $newStock): void
    {
        $newStock->branch_id = auth()->user()->branch_id;
        $newStock->user_id = auth()->id();
    }
}
