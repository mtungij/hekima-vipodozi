<?php

namespace App\Observers;
use App\Models\PaymentMethod;

class PaymentMethodObserver
{
    public function creating(PaymentMethod $paymentMethod): void
    {
        $paymentMethod->company_id = auth()->user()->company_id;
    }
}