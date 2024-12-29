<?php

namespace App\Livewire;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

class InvoiceDetail extends Component
{
    public ?Order $invoice;

    public function mount(Order $invoice)
    {
        $this->invoice = Order::where('id', $invoice->id)->with(['orderItems.product', 'customer'])->first();
    }

    public function deleteInvoice(Order $order)
    {
        $items = $order->orderItems()->get();
        
        // restore the stock of the associated items
        foreach ($items as $item) {
            $product = Product::find($item->product_id);

            $product->increment('stock', $item->qty);

            // delete item
            OrderItem::find($item->id)->delete();
        }

        // finally, delete the order
        $order->delete();

        session()->flash('success', 'Invoice delete successfully.');

        $this->redirect(route('invoices'), navigate: true);
    }

    public function deleteInvoiceItem(OrderItem $orderItem)
    {
        // restore the stock of the associated product
        Product::find($orderItem->product_id)->increment('stock', $orderItem->qty);

        // delete the item
        $orderItem->delete();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.invoice-detail');
    }
}
