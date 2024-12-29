<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class PointOfSale extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.point-of-sale', [
            'totalItems' => auth()->user()->cartItems()->count(),
        ]);
    }
}
