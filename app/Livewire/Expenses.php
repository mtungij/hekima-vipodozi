<?php

namespace App\Livewire;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Expenses extends Component
{
    public ?Collection $expenses;

    public function mount()
    {
        $this->getExpenses();
    }

    #[On('expense-created')]
    public function getExpenses()
    {
        $this->expenses = Expense::with(['expenseItems', 'paymentMethod'])->where('user_id', auth()->id())
                                ->whereDate('created_at', today())
                                ->withSum('expenseItems', 'cost')
                                ->get();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.expenses');
    }
}
