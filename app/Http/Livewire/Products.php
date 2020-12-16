<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public $code;
    public $name;
    public $price;

    public function resetInputFields() {
        $this->code = '';
        $this->name = '';
        $this->price = '';
    }

    public function store() {
        $data = $this->validate([
            'code' => 'required',
            'name' => 'required',
            'price' => 'required | numeric',
        ]);
        Product::create($data);
        session()->flash('message','Product created successfully');
        $this->resetInputFields();
        $this->emit('productCreated');
    }

    public function render()
    {
        $products = Product::all()->reverse();
        return view('livewire.products',['products'=>$products])
                    ->extends('layouts.app')
                    ->section('content');
    }
}
