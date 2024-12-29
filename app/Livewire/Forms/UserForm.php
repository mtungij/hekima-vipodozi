<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    
    public ?User $user;

    #[Validate('required|string|max:50')]
    public ?string $name = '';

    #[Validate('required|string|email|unique:users')]
    public string $email = '';

    #[Validate('required|string|max:20|min:9|unique:users')]
    public ?string $phone = '';

    #[Validate('required')]
    public ?int $branch_id = null;

    #[Validate('required')]
    public ?string $role = '';

    #[Validate('nullable|image|max:1024')] // 1MB max
    public $avatar;

    #[Validate('required|string|confirmed|min:6')]
    public ?string $password = '';

    public ?string $password_confirmation = '';


    public function store(): void
    {
        $avatarUrl = null;

        if ($this->branch_id)
            $avatarUrl = $this->avatar?->storePublicly(path: 'avatars');

        $this->branch_id = auth()->user()->branch_id;

        $this->validate();

        User::create([...$this->pull([
            'branch_id', 'name', 'email', 'phone', 'role', 'password'
        ]), 'company_id' => auth()->user()->company_id, 'avatar' => $avatarUrl]);

        $this->reset(['avatar', 'password_confirmation']);

    }

    public function setUser(User $user)
    {
        $this->user = $user;

        $this->name = $user->name;
        $this->branch_id = $user->branch_id;
        $this->role = $user->role;
    }

    public function update()
    {
        $this->validateOnly('branch_id');
        $this->validateOnly('name');
        $this->validateOnly('role');

        $this->user->update($this->only([
            'branch_id', 'name', 'role'
        ]));
    }
}

