<?php

namespace App\Livewire;

use App\Enums\Status;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class ProductSearch extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        
        return view('livewire.product-search', [
            'products' => Product::query()
                ->when($this->search, function ($query, $search) {
                    $query->where('nome', 'like', "%{$search}%")
                        ->orWhere('descricao', 'like', "%{$search}%");
                })
                ->where('status', Status::ATIVO)
                ->latest()
                ->paginate(10)
        ]);
    }
}
