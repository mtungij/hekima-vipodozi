<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{
    public Product $product;

    #[Validate('required|max:50|min:2')]
    public ?string $name = "";

    #[Validate('required|max:20')]
    public ?string $unit = "";

    #[Validate('required|numeric|max:999999999')]
    public ?float $buy_price;

    #[Validate('required|numeric|max:999999999')]
    public ?float $sale_price;

    #[Validate('required|numeric|max:999999999')]
    public ?float $whole_price = 0.00;

    #[Validate('required|numeric|max:9999999')]
    public ?float $stock;

    #[Validate('required|numeric|max:9999999')]
    public ?float $whole_stock = 0.00;

    #[Validate('required|numeric|max:9999999')]
    public ?float $stock_alert;

    #[Validate('required|numeric|max:9999999')]
    public ?float $transport = 0.00;

    #[Validate('nullable|string|max:20')]
    public ?string $expire_date = null;

    #[Validate('required|numeric|exists:companies,id')]
    public ?int $company_id = null;  

    public function store(): void
    {
        $this->validate();

        Product::create($this->pull([
            'name', 'unit', 'buy_price', 'sale_price','whole_price', 'whole_stock', 'stock', 'stock_alert', 'transport', 'expire_date', 'company_id'
        ]));
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;

        $this->name = $product->name;
        $this->unit = $product->unit;
        $this->buy_price = $product->buy_price;
        $this->sale_price = $product->sale_price;
        $this->whole_price = $product->whole_price;
        $this->whole_stock = $product->whole_stock;
        $this->stock = $product->stock;
        $this->stock_alert = $product->stock_alert;
        $this->expire_date = $product->expire_date;
        $this->transport = $product->transport;

    }

    public function update()
    {
        $this->validate();

        $this->product->update($this->all());
    }

    public function destroy(Product $product)
    {
        $product->delete();
    }
}
