<?php

namespace App\Livewire\SystemSetup;

use App\Models\Branch;
use Livewire\Component;

class Branches extends Component
{
    public function deleteBranch(Branch $branch): void
    {
        $branch->delete();

        $this->redirect(route('setup'), navigate:true);
    }
    
    public function render()
    {
        return view('livewire.system-setup.branches', [
            "branches" => Branch::where('company_id', auth()->user()->company_id)->get(),
        ]);
    }
}
