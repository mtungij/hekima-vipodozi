<?php

namespace App\Livewire;

use App\Models\NewStock;
use App\Models\NewStockItem;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

class NewStocks extends Component
{
    public $search;

    public function addToCart(Product $product)
    {
        $newStockExist = NewStock::where([
                                        ['user_id', auth()->id()],
                                        ['branch_id', auth()->user()->branch_id],
                                        ['status', 'pending']
                                    ])->first();


            if (!$newStockExist) {
                $newStock = NewStock::create();
                $newStock->newStockItems()->create([
                    'product_id' => $product->id,
                    'stock' => 0,
                ]);
            } else {
                $newStockExist->newStockItems()->create([
                    'product_id' => $product->id,
                    'stock' => 0,
                ]);
            }

        $this->dispatch('added-to-cart');
    }

    #[Layout('layouts.app')]
    public function render()
    {
         $productsExistToCart = NewStockItem::whereRelation('newStock', 'user_id', auth()->id())
                                            ->whereRelation('newStock', 'status', 'pending')
                                            ->pluck('product_id')->toArray();

        return view('livewire.new-stock', [
            'products' => Product::where('branch_id', auth()->user()->branch_id)
                                ->where('name', 'LIKE', '%'. $this->search .'%')
                                ->whereNotIn('id', $productsExistToCart)
                                ->orderBy('stock')
                                ->paginate(10),
        ]);
    }
}
