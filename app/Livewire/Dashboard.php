<?php

namespace App\Livewire;

use App\Models\ExpenseItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

class Dashboard extends Component
{
    #[Url()]
    public $from_date = null;

    #[Url()]
    public ?string $to_date = null;

    public function mount() {
        if(auth()->user()->role != 'admin') {
            $this->redirect(route('my-sales'), navigate:true);
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.dashboard', [
            'sales' => OrderItem::when(!$this->from_date && !$this->to_date, fn (Builder $query) => $query->whereDate('created_at', date('Y-m-d')))
                                  ->when($this->from_date && !$this->to_date, fn (Builder $query) => $query->whereDate('created_at', '>=', $this->from_date))
                                  ->when(!$this->from_date && $this->to_date, fn (Builder $query) => $query->whereDate('created_at', '<=', $this->to_date))
                                  ->when($this->from_date && $this->to_date, fn (Builder $query) => 
                                                                                                    $query->whereDate('created_at', '>=', $this->from_date)
                                                                                                          ->whereDate('created_at', '<=', $this->to_date))
                                  ->sum('total'),

            'profit' => OrderItem::when(!$this->from_date && !$this->to_date, fn (Builder $query) => $query->whereDate('created_at', date('Y-m-d')))
                                  ->when($this->from_date && !$this->to_date, fn (Builder $query) => $query->whereDate('created_at', '>=', $this->from_date))
                                  ->when(!$this->from_date && $this->to_date, fn (Builder $query) => $query->whereDate('created_at', '<=', $this->to_date))
                                  ->when($this->from_date && $this->to_date, fn (Builder $query) => 
                                                                                                    $query->whereDate('created_at', '>=', $this->from_date)
                                                                                                          ->whereDate('created_at', '<=', $this->to_date))
                                    ->sum('profit'),
            'capital' => Product::sum('capital'),
            'expenses' => ExpenseItem::when(!$this->from_date && !$this->to_date, fn (Builder $query) => $query->whereDate('created_at', date('Y-m-d')))
                                  ->when($this->from_date && !$this->to_date, fn (Builder $query) => $query->whereDate('created_at', '>=', $this->from_date))
                                  ->when(!$this->from_date && $this->to_date, fn (Builder $query) => $query->whereDate('created_at', '<=', $this->to_date))
                                  ->when($this->from_date && $this->to_date, fn (Builder $query) => 
                                                                                                    $query->whereDate('created_at', '>=', $this->from_date)
                                                                                                          ->whereDate('created_at', '<=', $this->to_date))
                                  ->sum('cost'),
            'users' => User::where('branch_id', auth()->user()->branch_id)
                            ->withSum(['orderItems' => function (Builder $query) {
                            $query->when($this->from_date && !$this->to_date, function (Builder $query) {
                                    $query->whereDate('order_items.created_at', '>=', $this->from_date);
                                })
                                ->when(!$this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('order_items.created_at', '<=', $this->to_date);
                                })
                                ->when($this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('order_items.created_at', '>=', $this->from_date)
                                          ->whereDate('order_items.created_at', '<=', $this->to_date);
                                })
                                ->when(!$this->from_date && !$this->to_date, fn (Builder $query) => $query->whereDate('order_items.created_at', date('Y-m-d')));
                        }], 'total')
                        ->withSum(['orderItems' => function (Builder $query) {
                            $query->when($this->from_date && !$this->to_date, function (Builder $query) {
                                    $query->whereDate('order_items.created_at', '>=', $this->from_date);
                                })
                                ->when(!$this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('order_items.created_at', '<=', $this->to_date);
                                })
                                ->when($this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('order_items.created_at', '>=', $this->from_date)
                                          ->whereDate('order_items.created_at', '<=', $this->to_date);
                                })
                                ->when(!$this->from_date && !$this->to_date, fn (Builder $query) => $query->whereDate('order_items.created_at', date('Y-m-d')));
                        }], 'profit')
                        ->withSum(['expenseItems' => function (Builder $query) {
                            $query->when($this->from_date && !$this->to_date, function (Builder $query) {
                                    $query->whereDate('expense_items.created_at', '>=', $this->from_date);
                                })
                                ->when(!$this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('expense_items.created_at', '<=', $this->to_date);
                                })
                                ->when($this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('expense_items.created_at', '>=', $this->from_date)
                                          ->whereDate('expense_items.created_at', '<=', $this->to_date);
                                })
                                ->when(!$this->from_date && !$this->to_date, fn (Builder $query) => $query->whereDate('expense_items.created_at', date('Y-m-d')));
                        }], 'cost')
                        ->get()
        ]);
    }
}
