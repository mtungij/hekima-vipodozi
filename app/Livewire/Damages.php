<?php

namespace App\Livewire;

use App\Models\DamageProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Damages extends Component
{
    public $search;

    #[Url()]
    public $user_id = null;

    public $date;

    #[Computed()]
    #[On('damages-changed')]
    public function damages()
    {
        return DamageProduct::with(['product', 'user'])
                        ->whereRelation('product', 'name', 'LIKE', "%{$this->search}%")
                        ->when($this->date, fn (Builder $query) =>$query->whereDate('created_at', $this->date))
                        ->when($this->user_id, fn (Builder $query) => $query->where('user_id', $this->user_id))
                        ->paginate(25);
    }

    public function delete(DamageProduct $damageProduct)
    {
        $product = Product::find($damageProduct->product_id)
                        ->increment('stock', $damageProduct->amount);

        $damageProduct->delete();
    }


    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.damages', [
            'total' => DamageProduct::count(),
            'users' => User::where('branch_id', auth()->user()->branch_id)->get(),
        ]);
    }
}
