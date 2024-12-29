<?php

namespace App\Livewire;

use App\Models\StockTransfer;
use App\Models\StockTransferItem;
use Livewire\Attributes\Layout;
use Livewire\Component;

class StockTransferDetail extends Component
{
    public StockTransfer $stockTransfer;
    
    public function mount(StockTransfer $stockTransfer)
    {
        $this->stockTransfer = $stockTransfer;
    }

    #[Layout("layouts.app")]
    public function render()
    {
        return view('livewire.stock-transfer-detail', [
            'items'=> $this->stockTransfer->stockTransferItems()->with('product')->get(),
        ]);
    }
}
