<?php

namespace App\Observers;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class CustomerObserver
{
    public function creating(Customer $customer): void
    {
        $customer->branch_id = auth()->user()->branch_id;
    }
}
