<?php

namespace App\Livewire\Pendingorders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\OrderItem;

class EditStock extends Component
{



    public $id = null;

    public ?Collection $orderItems = null;

    public function mount($order_id) {
        $this->id = $order_id;
        $this->getOrderItems();
    }

    #[On('item-updated')]
    public function getOrderItems()
    {
       $this->orderItems = OrderItem::with('product')->where('order_id', $this->id)->get();
    }

    public function approve(Order $order)
    {
        $items = $order->orderItems()->get();

        // if v_balance is found, return to it's product's stock
        foreach ($items as $item) {
            $product = Product::find($item->product_id);

            $product->increment('stock', $item->v_balance);
        }

        // update the order status
        $order->update(['status' => 'approved']);

        session()->flash('success', 'Approved successfully.');

        $this->redirect(route('pending-orders'), navigate:true);
    }

    public function render()
    {
        return view('livewire.pendingorders.edit-stock');
    }
}
