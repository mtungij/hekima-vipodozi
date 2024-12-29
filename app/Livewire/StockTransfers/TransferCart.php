<?php

namespace App\Livewire\StockTransfers;

use App\Models\Branch;
use App\Models\Product;
use App\Models\StockTransfer;
use App\Models\StockTransferItem;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class TransferCart extends Component
{
     use WithPagination;

     
    #[Url()]
    #[Validate('required')]
    public $branch_id = null;

    #[Computed(seconds:2)]
    #[On('added-to-cart')]
    #[On('item-updated')]
    public function transfers()
    {
        return StockTransferItem::with('product')->whereRelation('stockTransfer', 'status', 'pending')->paginate(15);
    }

    public function saveBranchId()
    {
        $stockTransferExist = StockTransfer::where([
                                        ['user_id', auth()->id()],
                                        ['branch_id', auth()->user()->branch_id],
                                        ['status', 'pending']
                                    ])->first();

        if (!$stockTransferExist) {
            StockTransfer::create([
                'to_branch_id' => $this->branch_id,
            ]);
        } else {
            $stockTransferExist->update([
                'to_branch_id' => $this->branch_id,
            ]);
        }
    }

    public function transfer()
    {
        $this->validate();

        $stockTransfer = StockTransfer::where([
                                        ['user_id', auth()->id()],
                                        ['branch_id', auth()->user()->branch_id],
                                        ['status', 'pending']
                                    ])->first();

        $items = $stockTransfer->stockTransferItems()->with('product')->get();

        DB::transaction(function () use($items, $stockTransfer) {
            foreach ($items as $item) {
                // check if the product exist to the toBranch
                $productExist = Product::where('branch_id',  $this->branch_id)
                                            ->where(function (Builder $query) use ($item) {
                                                      $query->where('product_id', $item->product_id)
                                                            ->orWhere('id', $item->product->product_id);
                                                    })->first();

                // if product exist to toBranch increment it's stock and decrement the
                // stock to the fromBranch(branch_id)  else create new one and decrement                               
                if($productExist) {
                    $productExist->increment('stock', $item->stock);
                    Product::find($item->product_id)->decrement('stock', $item->stock);
                } else {
                    Product::create([
                        'branch_id' => $this->branch_id,
                        'name' => $item->product->name,
                        'product_id' => $item->product_id,
                        'unit' => $item->product->unit,
                        'buy_price' => $item->product->buy_price,
                        'sale_price' => $item->product->sale_price,
                        'whole_price' => $item->product->whole_price,
                        'whole_stock' => $item->product->whole_stock,
                        'stock' => $item->stock,
                        'stock_alert' => $item->product->stock_alert,
                        'expire_date' => $item->product->expire_date,
                        'transport' => $item->product->transport,
                    ]);

                    Product::find($item->product_id)->decrement('stock', $item->stock);
                }
            }
    
            // update status to transfered
            $stockTransfer->update(['status' => 'transfered']);

        }, 3);

        session()->flash('success', 'Products transfered successfully.');

        // redirect to transfered products for printing
        $this->redirect(route('stock-transfer.preview', $stockTransfer->id), navigate:true);
    }

    public function delete(StockTransferItem $stockTransferItem)
    {
        $stockTransferItem->delete();

        session()->flash('success', 'Item deleted successfully.');

        $this->redirect(route('stock-transfer'), navigate:true);
    }

    public function render()
    {
        return view('livewire.stock-transfers.transfer-cart', [
            'branches' => Branch::where('id', '!=', auth()->user()->branch_id)->get(),
        ]);
    }
}
