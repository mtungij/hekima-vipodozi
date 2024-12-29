<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class AllProducts extends Component
{
    use WithPagination;

    public ?string $search = '';

    #[Computed]
    #[On('product-created')]
    #[On('product-deleted')]
    #[On('product-updated')]
    public function products()
    {
        return Product::where('name', 'LIKE', "%{$this->search}%")
                         ->where('branch_id', auth()->user()->branch_id)
                         ->paginate(15);
    }

    public function deleteProduct(Product $product): void
    {
        $product->delete();

        session()->flash('Deleted successfully!');

        $this->dispatch('product-deleted');
    }

    public function render()
    {
        return view('livewire.products.all-products', [
            'total' => Product::where('branch_id', auth()->user()->branch_id)->count(),
            'low' => Product::where('branch_id', auth()->user()->branch_id)->whereColumn('stock', '<', 'stock_alert')->count(),
            'empty' => Product::where('branch_id', auth()->user()->branch_id)->where('stock', '=', 0)->count(),
            'expired' => Product::where('branch_id', auth()->user()->branch_id)->where('expire_date', '<=', today())->count(),
        ]);
    }
}
