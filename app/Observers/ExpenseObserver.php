<?php

namespace App\Observers;
use App\Models\Expense;

class ExpenseObserver
{
    public function creating(Expense $expense): void
    {
        $expense->branch_id = auth()->user()->branch_id;
        $expense->user_id = auth()->id();
    }
}
