<?php

namespace App\Livewire\Products;

use App\Livewire\Forms\ProductForm;
use Livewire\Component;

class CreateProduct extends Component
{
    public ProductForm $form;

    public function store(): void
    {
        $this->form->store();

        session()->flash('success', 'Created successfully.');

        $this->dispatch('product-created');
    }
    
    public function render()
    {
        return view('livewire.products.create-product');
    }
}
