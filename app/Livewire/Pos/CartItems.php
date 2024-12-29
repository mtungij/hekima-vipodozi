<?php

namespace App\Livewire\Pos;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class CartItems extends Component
{
    public ?float $qty = 0;

    #[Computed]
    #[On('cartItem-deleted')]
    #[On('added-to-cart')]
    #[On('cartItem-updated')]
    public function cartItems(): Collection
    {
        return CartItem::with('product')->whereRelation('cart', 'user_id', auth()->id())->get();
    }

    public function updateItem(CartItem $item, $quantity)
    {
        $item->update(['qty' => $quantity]);

        $this->dispatch('cartItem-updated');
    }

    public function deleteItem(CartItem $item)
    {
        $item->delete();

        session()->flash('success', 'Item deleted successfully.');
        $this->redirect(route('pos'), navigate:true);
    }

    public function render()
    {
        return view('livewire.pos.cart-items');
    }
}
