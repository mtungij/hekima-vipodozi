<?php

namespace App\Livewire\SystemSetup;

use App\Livewire\Forms\BranchForm;
use App\Models\Branch;
use Livewire\Component;

class CreateBranch extends Component
{
    public BranchForm $form;

    public function createBranch(): void
    {
        $this->validate();

        Branch::create(
            $this->form->pull()
        );

        $this->redirect(route('setup'),  navigate:true);
    }

    public function render()
    {
        return view('livewire.system-setup.create-branch');
    }
}
