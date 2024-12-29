<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Order;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

use function Spatie\LaravelPdf\Support\pdf ;

class Invoices extends Component
{
    use WithPagination;

    public ?string $search = null;
    
    #[Url()]
    public ?int $branch_id = null;

    #[Url()]
    public ?string $from_date = null;

    #[Url()]
    public ?string $to_date = null;

    public function clearFromDate()
    {
        $this->from_date = null;
    }

    public function clearToDate()
    {
        $this->to_date = null;
    }

    public function clearAlldates()
    {
        $this->from_date = null;
        $this->to_date = null;
    }


    #[Layout('layouts.app')]
    public function render()
    {
        $invoices = Order::query()
                        ->when($this->search, function (Builder $query) {
                            $query->where('id',$this->search);
                        })
                        ->when($this->branch_id, function (Builder $query) {
                            $query->where('branch_id', $this->branch_id);
                        })
                        ->when($this->from_date && !$this->to_date, function (Builder $query) {
                            $query->whereDate('created_at', '>=', $this->from_date);
                        })
                        ->when(!$this->from_date && $this->to_date, function (Builder $query) {
                            $query->whereDate('created_at', '<=', $this->to_date);
                        })
                        ->when($this->from_date && $this->to_date, function (Builder $query) {
                            $query->whereDate('created_at', '<=', $this->to_date)
                                  ->whereDate('created_at', '>=', $this->from_date);
                        })
                        ->withSum('orderItems', 'total')
                        ->with(['customer', 'branch', 'paymentMethod', 'user', 'vendor'])
                        ->paginate(15);

        return view('livewire.invoices', [
            'total' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'credit' => Order::where('status', 'credit')->count(),
            'paid' => Order::where('status', 'paid')->count(),
            'invoices' => $invoices,
            'branches' => Branch::get(),
        ]);
    }
}
