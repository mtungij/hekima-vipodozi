<?php

namespace App\Livewire;

use App\Models\ExpenseItem;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class MySales extends Component
{
    public $search = null;

    #[Computed()]
    public function products()
    {
        return OrderItem::with(['order.user', 'product'])
                        ->whereRelation('product', 'name', 'LIKE', "%{$this->search}%")
                        ->whereDate('created_at', today())
                        ->whereRelation('order', 'user_id', auth()->id())
                        ->latest()->paginate(100);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.my-sales', [
            'sales' => OrderItem::whereRelation('order', 'user_id', auth()->user()->id)
                                  ->whereDate('created_at', today())
                                  ->sum('total'),


            'expenses' => ExpenseItem::whereRelation('expense','user_id', auth()->user()->id)
                                  ->whereDate('created_at', today())
                                  ->sum('cost'),

        ]);
    }
}
