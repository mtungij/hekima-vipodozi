<?php

namespace App\Livewire\Products;

use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class EditProduct extends Component
{
    public ProductForm $form;

    public function mount(Product $product)
    {
        $this->form->setProduct($product);
    }

    public function updateProduct(Product $product)
    {
        $this->form->update();
        
        $this->dispatch('product-updated');
    }

    public function render()
    {
        return view('livewire.products.edit-product');
    }
}
