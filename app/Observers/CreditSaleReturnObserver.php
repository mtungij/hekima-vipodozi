<?php

namespace App\Observers;
use App\Models\CreditSaleReturn;

class CreditSaleReturnObserver
{
    public function creating(CreditSaleReturn $creditSaleReturn): void
    {
        $creditSaleReturn->branch_id = auth()->user()->branch_id;
        $creditSaleReturn->receiver_id = auth()->id();
    }
}
