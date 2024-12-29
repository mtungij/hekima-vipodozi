<?php

namespace App\Livewire\Products;

use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use Livewire\Component;

class ViewProduct extends Component
{
    public ProductForm $form;

    public function mount(Product $product)
    {
        $this->form->setProduct($product);
    }

    public function render()
    {
        return view('livewire.products.view-product');
    }
}
