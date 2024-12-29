<?php

namespace App\Observers;
use App\Models\Branch;

class BranchObserver
{
    public function creating(Branch $branch): void
    {
        $branch->company_id = auth()->user()->company_id;
    }
}
