<?php

namespace App\Observers;
use App\Models\Order;

class OrderObserver
{
    public function creating(Order $order): void
    {
        $order->branch_id = auth()->user()->branch_id;
    }
}
