<?php

namespace App\Livewire\Expenses;

use App\Models\Expense;
use App\Models\PaymentMethod;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateExpense extends Component
{
    #[Url()]
    #[Validate('required')]
    public ?int $payment_method_id;

    #[Validate('required|max:100|min:5')]
    public ?string $item = '';

    #[Validate('required|numeric|max:999999999')]
    public $cost;

    public function store()
    {
        $validated = $this->validate();

        $todayExpense = Expense::whereDate('created_at', today())
                            ->where([['user_id', auth()->id()], ['payment_method_id', $this->payment_method_id]])->first();

        if($todayExpense) {
            $todayExpense->expenseItems()->create($validated);
        } else {
            $expense = Expense::create([
                'payment_method_id' => $this->payment_method_id,
            ]);

            $expense->expenseItems()->create($validated);
        }

        $this->reset(['item', 'cost']);

        session()->flash('success', 'Created successfully.');

        $this->dispatch('expense-created');
    }

    public function render()
    {
        return view('livewire.expenses.create-expense', [
            'payments' => PaymentMethod::get(),
        ]);
    }
}
