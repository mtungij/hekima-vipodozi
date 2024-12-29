<?php

namespace App\Livewire\StockTransfers;

use App\Models\StockTransfer;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class TransferedStock extends Component
{
    use WithPagination;

    public $date = null;

    public function delete(StockTransfer $stockTransfer)
    {
        $stockTransfer->delete();
    }

    #[Layout("layouts.app")]
    public function render()
    {
        return view('livewire.stock-transfers.transfered-stock', [
            'transfers' => StockTransfer::with(['branch', 'toBranch'])
                                    ->when($this->date, function (Builder $query) {
                                        $query->whereDate('created_at', $this->date);
                                    })
                                    ->withCount('stockTransferItems')
                                    ->latest()
                                    ->paginate(15),
        ]);
    }
}
