<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public $_id;
    public $code;
    public $name;
    public $price;

    protected $listeners = ['openProductEditModal' => 'edit','closeProductEditModal'=>'resetInputFields'];

    public function resetInputFields() {
        $this->_id = '';
        $this->code = '';
        $this->name = '';
        $this->price = '';
    }

    public function updatedCode() {
        // dd($this->_id);
        $code_rules = ['required'];
        if($this->_id) {
            $code_rules = array_merge($code_rules,['unique:products,code,'.$this->_id]);
        }
        // dd($code_rules);
        $data = $this->validate(['code'=>$code_rules]);
    }

    public function store() {
        $data = $this->validate([
            'code' => 'required | unique:products',
            'name' => 'required',
            'price' => 'required | numeric',
        ]);
        $product = Product::create($data);
        session()->flash('message',"Product '$product->name' created successfully");
        $this->resetInputFields();
        $this->emit('productCreated');
    }

    public function edit($id) {
        $product = Product::where('id',$id)->first();
        $this->_id = $product->id;
        $this->code = $product->code;
        $this->name = $product->name;
        $this->price = $product->price;
    }

    public function update() {
        $data = $this->validate([
            'code' => 'required | unique:products,code,'.$this->_id,
            'name' => 'required',
            'price' => 'required | numeric',
        ]);
        $product = Product::find($this->_id);
        $product->update($data);
        session()->flash('message',"Product '$product->name' updated successfully");
        $this->resetInputFields();
        $this->emit('productUpdated');
    }

    public function delete() {
        Product::destroy($this->_id);
        session()->flash('message',"Product deleted successfully");
        $this->resetInputFields();
        $this->emit('productDeleted');
    }

    public function render()
    {
        $products = Product::all()->reverse();
        return view('livewire.products',['products'=>$products])
                    ->extends('layouts.app')
                    ->section('content');
    }
}
