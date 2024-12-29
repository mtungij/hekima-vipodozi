<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\Branch;
use App\Models\User;
use Livewire\Component;

class EditUser extends Component
{
    public UserForm $form;

    public function mount(User $user)
    {
        $this->form->setUser($user);
    }

    public function updateUser()
    {
        $this->form->update();

        $this->dispatch('user-updated');
    }

    public function render()
    {
        return view('livewire.user.edit-user', [
            'branches' => Branch::get(),
        ]);
    }
}
