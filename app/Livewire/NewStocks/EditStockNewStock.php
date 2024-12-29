<?php

namespace App\Livewire\NewStocks;

use App\Models\NewStockItem;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditStockNewStock extends Component
{
    public NewStockItem $item; 

    public $stock = 0.00;

    public function mount(NewStockItem $item)
    {
        $this->stock = $item->stock;
    }

    public function updateItem()
    {
        $stock = (float) str_replace(',', '', $this->stock);

        $this->item->update(['stock' => $stock]);

        $this->dispatch('item-updated');
    }

    public function render()
    {
        return view('livewire.new-stocks.edit-stock-new-stock');
    }
}
