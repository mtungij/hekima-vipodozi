<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PendingOrders extends Component
{
    use WithPagination;

     public ?string $search = null;
    
    #[Url()]
    public ?int $branch_id = null;

    #[Url()]
    public ?int $user_id = null;

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

    // approve all products
    public function approve(Order $order)
    {
        $items = $order->orderItems()->get();

        foreach ($items as $item) {
            OrderItem::find($item->id)->update(['qty' => $item->v_qty]);
        }

        // update the order status
        $order->update(['status' => 'approved']);

        session()->flash('success', 'All products approved successfully.');

        $this->redirect(route('pending-orders'), navigate:true);
    }


    #[Layout('layouts.app')]
    public function render()
    {
        $orders = Order::where('status', 'pending')
                        ->when($this->search, function (Builder $query) {
                            $query->where('id',$this->search)
                                  ->orWhereRelation('customer', 'name', 'LIKE', "%$this->search%");
                        })
                        ->when($this->branch_id, function (Builder $query) {
                            $query->where('branch_id', $this->branch_id);
                        })
                        ->when($this->user_id, function (Builder $query) {
                            $query->where('user_id', $this->user_id)
                                   ->orWhere('vendor_id', $this->user_id);
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
                        ->withSum('orderItems', 'v_total')
                        ->withCount('orderItems')
                        ->with(['customer', 'user', 'vendor'])
                        ->paginate(15);

        return view('livewire.pending-orders', [
            'orders' => $orders,
            'branches' => Branch::get(),
            'users' => User::where([['company_id', auth()->user()->company_id]])
                                ->orderBy('name')->get(),
        ]);
    }
}
