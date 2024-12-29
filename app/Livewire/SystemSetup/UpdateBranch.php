<?php

namespace App\Livewire\SystemSetup;

use App\Livewire\Forms\BranchForm;
use App\Models\Branch;
use Livewire\Component;

class UpdateBranch extends Component
{

    public BranchForm $form;

    public function mount(Branch $branch) {
        $this->form->setBranch($branch);
    }

    public function update() {
        $this->form->update();

        $this->redirect(route('setup'), navigate:true);
    }

    public function render()
    {
        return view('livewire.system-setup.update-branch');
    }
}
