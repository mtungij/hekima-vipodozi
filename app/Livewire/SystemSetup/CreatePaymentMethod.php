<?php

namespace App\Livewire\SystemSetup;

use Livewire\Attributes\Validate;
use Livewire\Component;

class CreatePaymentMethod extends Component
{
    #[Validate('required|max:50')]
    public ?string $name = '';
    
    public function store()
    {
        $this->validate();

        \App\Models\PaymentMethod::create($this->all());

        $this->reset();

        $this->dispatch('payment-created');
    }
    public function render()
    {
        return view('livewire.system-setup.create-payment-method');
    }
}
