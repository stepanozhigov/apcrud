<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Order extends Component
{
    
    public $products;

    protected $listeners = [
        //'addProductToOrder' => 'productAddedCallback',
        //'removeProductFromOrder' => 'productRemovedCallback',
    ];

    public function productAddedCallback(Product $product) {
        $this->products[] = $product;
        //dd($this->products);
    }

    public function productRemovedCallback(Product $product) {
        $this->products = array_filter($this->products, function($item) use ($product) {
            return $product->id != $item->id;
        });
        //dd($this->products);
    }

    public function render()
    {
        return view('livewire.order')->extends('pages.order-page')->section('content');
    }
}
