<?php

namespace App\Livewire\SystemSetup;

use Livewire\Attributes\On;
use Livewire\Component;

class PaymentMethod extends Component
{
    public $paymentMethods = [];

    public function mount()
    {
        $this->getPaymentMethods();
    }

    public function deletePayment(\App\Models\PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();

        $this->dispatch('payment-deleted');
    }

    #[On('payment-created')]
    #[On('payment-deleted')]
    public function getPaymentMethods()
    {
        $this->paymentMethods = \App\Models\PaymentMethod::where('company_id', auth()->user()->company_id)->get();
    }

    public function render()
    {
        return view('livewire.system-setup.payment-method');
    }
}
