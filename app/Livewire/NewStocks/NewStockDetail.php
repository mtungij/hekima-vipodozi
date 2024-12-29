<?php

namespace App\Livewire\NewStocks;

use App\Models\NewStock;
use Livewire\Attributes\Layout;
use Livewire\Component;

class NewStockDetail extends Component
{
    public NewStock $newStock;
    
    public function mount(NewStock $newStock)
    {
        $this->newStock = $newStock;
    }

    #[Layout("layouts.app")]
    public function render()
    {
        return view('livewire.new-stocks.new-stock-detail', [
            'items'=> $this->newStock->newStockItems()->with('product')->get(),
        ]);
    }
}
