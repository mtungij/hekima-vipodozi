<?php

namespace App\Livewire\CreditSales;

use App\Models\CreditSaleReturn;
use App\Models\Order;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PayCreditSale extends Component
{
    public ?Order $order;

    #[Validate('required|numeric|max:999999999|min:0')]
    public $amount;

    #[Validate('required')]
    public $payment_method_id;

    public function payDebt()
    {
        $this->validate();

        $totalPrice = (int) $this->order->orderItems()->sum('total');
        $amountPaid = (int) CreditSaleReturn::where('order_id', $this->order->id)?->sum('amount');

        $debt = $totalPrice - $amountPaid;

        if($this->amount >= $debt) {
            // pay only the debt 
            CreditSaleReturn::create([
                'order_id' => $this->order->id,
                'payment_method_id' => $this->payment_method_id,
                'amount' => $debt,
            ]);

            // complete the debt
            Order::find($this->order->id)->update(['status' => 'paid']);
        } else {
            CreditSaleReturn::create([
                'order_id' => $this->order->id,
                'payment_method_id' => $this->payment_method_id,
                'amount' => $this->amount,
            ]);
        }

        Session::flash('success', 'payment successfully.');

        $this->redirect(route('credit-sales.view', $this->order->id), navigate:true);
    }
    public function render()
    {
        return view('livewire.credit-sales.pay-credit-sale', [
             'payments' => PaymentMethod::get(),
        ]);
    }
}
