<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\StockTransfer;
use App\Models\StockTransferItem;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class StockTransfers extends Component
{
    use WithPagination;

    public ?string $search = null;

    public function addToCart(Product $product)
    {
        $stockTransferExist = StockTransfer::where([
                                        ['user_id', auth()->id()],
                                        ['branch_id', auth()->user()->branch_id],
                                        ['status', 'pending']
                                    ])->first();

        if($product->stock <= 0) {
            session()->flash('error', "{$product->name} do not have enough stock.");
            return $this->redirect(route('stock-transfer'), navigate:true);
        } else {
            if (!$stockTransferExist) {
                $stockTransfer = StockTransfer::create();
                $stockTransfer->stockTransferItems()->create([
                    'product_id' => $product->id,
                    'stock' => 0,
                ]);
            } else {
                $stockTransferExist->stockTransferItems()->create([
                    'product_id' => $product->id,
                    'stock' => 0,
                ]);
            }
        }


        $this->dispatch('added-to-cart');
    }
    
    #[Layout('layouts.app')]
    public function render()
    {
        $productsExistToCart = StockTransferItem::whereRelation('stockTransfer', 'user_id', auth()->id())
                                            ->whereRelation('stockTransfer', 'status', 'pending')->pluck('product_id')->toArray();

        return view('livewire.stock-transfer', [
            'products' => Product::where('branch_id', auth()->user()->branch_id)
                                    ->where('name', 'LIKE', "%{$this->search}%")
                                    ->whereNotIn('id', $productsExistToCart)
                                    ->paginate(10),
        ]);
    }
}
