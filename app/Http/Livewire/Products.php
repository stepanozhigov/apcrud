<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public function render()
    {
        $products = Product::all()->reverse();
        return view('livewire.products',['products'=>$products]);
    }
}
