<?php

namespace App\Livewire\Products\Imports;

use App\Models\Branch;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ImportProductFromBranch extends Component
{
    use WithPagination;

    public ?string $search = '';

    #[Url()]
    public $branch_id = '';

    #[Computed]
    #[On('imported-from-branch')]
    public function products(): LengthAwarePaginator
    {
        $currentBranchProducts = Product::where('branch_id', auth()->user()->branch_id)
                                           ->pluck('product_id');

        return Product::where('name', 'LIKE', "%{$this->search}%")
                         ->where('branch_id', $this->branch_id)
                         ->where('product_id', 0)
                         ->whereNotIn('id', $currentBranchProducts)
                         ->paginate(10);
    }

    public function importProduct(Product $product): void
    {
        $item = Arr::except($product->toArray(), ['branch_id', 'product_id', 'stock', 'stock_alert']);

        Product::create([
            'branch_id' => auth()->user()->branch_id,
            'product_id' => $product->id,
            'stock' => 0.00,
            'stock_alert' => 0,
            ...$item
        ]);

        session()->flash('success', __('Imported successfully.'));

        $this->dispatch('imported-from-branch');
    }

    public function importAllProducts(): void
    {
        //code
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.products.imports.import-product-from-branch', [
            'branches' => Branch::where('id', '!=', auth()->user()->branch_id)->get(),
        ]);
    }
}
