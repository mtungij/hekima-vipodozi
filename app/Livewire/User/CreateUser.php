<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\Branch;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateUser extends Component
{
    use WithFileUploads;

    public UserForm $form;

    public function createUser()
    {
        $this->form->store();

        session()->flash('success', 'user created successfully.');
        $this->dispatch('user-created');
    }

    public function render()
    {
        return view('livewire.user.create-user', [
            'branches' => Branch::get(),
        ]);
    }
}
