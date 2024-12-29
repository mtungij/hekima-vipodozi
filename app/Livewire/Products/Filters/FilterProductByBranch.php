<?php

namespace App\Livewire\Products\Filters;

use App\Models\Branch;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class FilterProductByBranch extends Component
{
    use WithPagination;

    public ?string $search = '';

    #[Computed()]
    public function branches(): LengthAwarePaginator
    {
        return Branch::where('name', 'LIKE', "%{$this->search}%")->paginate(5);
    }

    public function switchBranch(Branch $branch): void
    {
        auth()->user()->update(['branch_id' => $branch->id]);

        $this->redirect(url()->previous(), navigate:true);
    }

    public function render()
    {
        return view('livewire.products.filters.filter-product-by-branch');
    }
}
