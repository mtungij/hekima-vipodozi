<?php

namespace App\Livewire\Forms;

use App\Models\Branch;
use Livewire\Attributes\Validate;
use Livewire\Form;

class BranchForm extends Form
{
    public ?Branch $branch;

    #[Validate('required|min:3|max:50')]
    public $name = '';

    #[Validate('required|min:10|max:20')]
    public $phone = '';

    #[Validate('required|min:5|max:100')]
    public $address = '';

    #[Validate('nullable|min:8|max:20')]
    public $taxt_id = '';

    public function setBranch(Branch $branch): void
    {
        $this->branch = $branch;

        $this->name = $branch->name;
        $this->phone = $branch->phone;
        $this->address = $branch->address;
        $this->taxt_id = $branch->taxt_id;
    }

    public function store(): void
    {
        $this->validate();

        Branch::create($this->pull());
    }

    public function update(): void
    {
        $this->validate();

        $this->branch->update(
            $this->all()
        );
        $this->reset();
    }


}
