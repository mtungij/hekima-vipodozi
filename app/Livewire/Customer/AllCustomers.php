<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class AllCustomers extends Component
{
    use WithPagination;

    public ?string $search = '';

    #[Computed()]
    public function customers()
    {
        return Customer::where('name', 'LIKE', "%{$this->search}%")->paginate(25);
    }

    public function render()
    {
        return view('livewire.customer.all-customers', [
            'total' => Customer::count(),
        ]);
    }
}
