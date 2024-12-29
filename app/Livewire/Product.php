<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

class Product extends Component
{

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product');
    }
}
