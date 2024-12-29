<?php

namespace App\Livewire\NewStocks;

use App\Models\NewStock;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class AllNewStocks extends Component
{
    use WithPagination;

    public $date = null;

    public function delete(NewStock $newStock)
    {
        $newStock->delete();
    }

    #[Layout("layouts.app")]
    public function render()
    {
        return view('livewire.new-stocks.all-new-stocks', [
            'newStocks' => NewStock::with(['branch', 'toBranch'])
                                    ->when($this->date, function (Builder $query) {
                                        $query->whereDate('created_at', $this->date);
                                    })
                                    ->withCount('newStockItems')
                                    ->latest()
                                    ->paginate(15),
        ]);
    }
}
