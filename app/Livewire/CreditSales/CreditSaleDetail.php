<?php

namespace App\Livewire\CreditSales;

use App\Models\CreditSaleReturn;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreditSaleDetail extends Component
{
    public ?Order $order;

    public function mount(Order $order)
    {
        $this->order = Order::with(['orderItems.product', 'customer', 'user'])
                                ->withSum('orderItems', 'total')
                                ->withSum('creditSaleReturns', 'amount')
                                ->where('id', $order->id)
                                ->first();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.credit-sales.credit-sale-detail', [
            'returns' => CreditSaleReturn::with('receiver')->where('order_id', $this->order->id)->get(),
        ]);
    }
}
