<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class AllUsers extends Component
{
    use WithPagination;

    public ?string $search = '';

    #[Computed]
    #[On('user-created')]
    #[On('user-deleted')]
    #[On('user-updated')]
    public function users()
    {
        return User::with(['branch'])
                      ->where('company_id', auth()->user()?->company_id)
                      ->where('name', 'LIKE', "%{$this->search}%")
                      ->paginate(15);
    }


    public function deleteUser(User $user)
    {
        $user->delete();

        $this->dispatch('user-deleted');
    }

    public function download() {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
    
    public function render()
    {
        return view('livewire.user.all-users', [
            'total' => User::where('company_id', auth()->user()->company_id)->count(),
        ]);
    }
}
