<?php

namespace App\Livewire\NewStocks;

use App\Models\Branch;
use App\Models\NewStock;
use App\Models\NewStockItem;
use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class NewStockCart extends Component
{
    use WithPagination;

     
    #[Computed(seconds:2)]
    #[On('added-to-cart')]
    #[On('item-updated')]
    public function newStocks()
    {
        return NewStockItem::with('product')->whereRelation('newStock', 'status', 'pending')->paginate(15);
    }

    public function saveBranchId()
    {
        $newStockExist = NewStock::where([
                                        ['user_id', auth()->id()],
                                        ['branch_id', auth()->user()->branch_id],
                                        ['status', 'pending']
                                    ])->first();

        if (!$newStockExist) {
            NewStock::create([
                'to_branch_id' => $this->branch_id,
            ]);
        } else {
            $newStockExist->update([
                'to_branch_id' => $this->branch_id,
            ]);
        }
    }

    public function newstock()
    {
        $this->validate();

        $newStock = NewStock::where([
                                        ['user_id', auth()->id()],
                                        ['branch_id', auth()->user()->branch_id],
                                        ['status', 'pending']
                                    ])->first();

        $items = $newStock->newStockItems()->with('product')->get();

        foreach ($items as $item) {
                $product = Product::find($item->product_id);

                $product->increment('stock', $item->stock);
        }
    
        // update status 
        $newStock->update(['status' => 'added']);

        session()->flash('success', 'Products transfered successfully.');

        // redirect to transfered products for printing
        $this->redirect(route('new-stock.preview', $newStock->id), navigate:true);
    }

    public function delete(NewStockItem $newStockItem)
    {
        $newStockItem->delete();

        session()->flash('success', 'Item deleted successfully.');

        $this->redirect(route('new-stock'), navigate:true);
    }

    public function render()
    {
        return view('livewire.new-stocks.new-stock-cart', [
            'branches' => Branch::get(),
        ]);
    }
}
