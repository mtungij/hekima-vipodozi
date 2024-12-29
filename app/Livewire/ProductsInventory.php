<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsInventory extends Component
{
    use WithPagination;

    public $search;

    public $branch_id = null;
    
    #[Url()]
    public ?string $from_date = null;

    #[Url()]
    public ?string $to_date = null;

    #[Computed(seconds:10)]
    public function products()
    {
        return Product::when($this->search, function (Builder $query) {
                            $query->where('name', 'LIKE', "%{$this->search}%");
                        })
                        ->withCount(['orderItems' => function (Builder $query) {
                            $query->when($this->from_date && !$this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '>=', $this->from_date);
                                })
                                ->when(!$this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '<=', $this->to_date);
                                })
                                ->when($this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '>=', $this->from_date)
                                          ->whereDate('created_at', '<=', $this->to_date);
                                });
                        }])
                        ->withSum(['stockTransferItems' => function (Builder $query) {
                            $query->when($this->from_date && !$this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '>=', $this->from_date);
                                })
                                ->when(!$this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '<=', $this->to_date);
                                })
                                ->when($this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '>=', $this->from_date)
                                          ->whereDate('created_at', '<=', $this->to_date);
                                });
                        }], 'stock')
                        ->withSum(['newStockItems' => function (Builder $query) {
                            $query->when($this->from_date && !$this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '>=', $this->from_date);
                                })
                                ->when(!$this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '<=', $this->to_date);
                                })
                                ->when($this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '>=', $this->from_date)
                                          ->whereDate('created_at', '<=', $this->to_date);
                                });
                        }], 'stock')
                        ->withSum(['orderItems' => function (Builder $query) {
                            $query->when($this->from_date && !$this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '>=', $this->from_date);
                                })
                                ->when(!$this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '<=', $this->to_date);
                                })
                                ->when($this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '>=', $this->from_date)
                                          ->whereDate('created_at', '<=', $this->to_date);
                                });
                        }], 'qty')
                        ->withSum(['orderItems' => function (Builder $query) {
                            $query->when($this->from_date && !$this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '>=', $this->from_date);
                                })
                                ->when(!$this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '<=', $this->to_date);
                                })
                                ->when($this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '>=', $this->from_date)
                                          ->whereDate('created_at', '<=', $this->to_date);
                                });
                        }], 'total')
                        ->withSum(['orderItems' => function (Builder $query) {
                            $query->when($this->from_date && !$this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '>=', $this->from_date);
                                })
                                ->when(!$this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '<=', $this->to_date);
                                })
                                ->when($this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '>=', $this->from_date)
                                          ->whereDate('created_at', '<=', $this->to_date);
                                });
                        }], 'v_qty')
                        ->withSum(['orderItems' => function (Builder $query) {
                            $query->when($this->from_date && !$this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '>=', $this->from_date);
                                })
                                ->when(!$this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '<=', $this->to_date);
                                })
                                ->when($this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '>=', $this->from_date)
                                          ->whereDate('created_at', '<=', $this->to_date);
                                });
                        }], 'profit')
                        ->withAvg(['orderItems' => function (Builder $query) {
                            $query->when($this->from_date && !$this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '>=', $this->from_date);
                                })
                                ->when(!$this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '<=', $this->to_date);
                                })
                                ->when($this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '>=', $this->from_date)
                                          ->whereDate('created_at', '<=', $this->to_date);
                                });
                        }], 'total')
                        ->withAvg(['orderItems' => function (Builder $query) {
                            $query->when($this->from_date && !$this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '>=', $this->from_date);
                                })
                                ->when(!$this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '<=', $this->to_date);
                                })
                                ->when($this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '>=', $this->from_date)
                                          ->whereDate('created_at', '<=', $this->to_date);
                                });
                        }], 'profit')
                        ->withAvg(['orderItems' => function (Builder $query) {
                            $query->when($this->from_date && !$this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '>=', $this->from_date);
                                })
                                ->when(!$this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '<=', $this->to_date);
                                })
                                ->when($this->from_date && $this->to_date, function (Builder $query) {
                                    $query->whereDate('created_at', '>=', $this->from_date)
                                          ->whereDate('created_at', '<=', $this->to_date);
                                });
                        }], 'qty')
                        ->paginate(15);
}

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.products-inventory');
    }
}
