<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductsTableRow extends Component
{
    public $product;

    public function mount(Product $product) {
        
    }

    public function render()
    {
        return view('livewire.products-table-row');
    }
}
