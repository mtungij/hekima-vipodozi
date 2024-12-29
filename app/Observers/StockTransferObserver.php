<?php

namespace App\Observers;
use App\Models\StockTransfer;

class StockTransferObserver
{
    public function creating(StockTransfer $stockTransfer): void
    {
        $stockTransfer->branch_id = auth()->user()->branch_id;
        $stockTransfer->user_id = auth()->id();
    }
}
