<?php

namespace App\Livewire\StockTransfers;

use App\Models\StockTransferItem;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditStockTransfer extends Component
{
    public StockTransferItem $item; 

    #[Validate('required|string|min:0|max:10')]
    public $stock = 0.00;

    public function mount(StockTransferItem $item)
    {
        $this->stock = $item->stock;
    }

    public function updateItem()
    {
        $this->validate();
        
        $stock = (float) str_replace(',', '', $this->stock);

        if($stock > $this->item->product->stock) {
            $this->stock = $this->item->stock;

            session()->flash('error', 'stock is not enough.');

            return $this->redirect(route('stock-transfer'), navigate:true);
        }

        $this->item->update(['stock' => $stock]);

        $this->dispatch('item-updated');
    }
    
    public function render()
    {
        return view('livewire.stock-transfers.edit-stock-transfer');
    }
}
