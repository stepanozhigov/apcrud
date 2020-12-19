<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    //selected product id
    public $_id;

    //form fields
    public $code;
    public $name;
    public $price;

    //
    public $selected_products;

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
        $this->emit('productCreated',$product->id);
        $this->resetInputFields();
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
        $this->emit('productUpdated',$product->id);
        $this->resetInputFields();
    }

    public function delete() {
        Product::destroy($this->_id);
        $this->emit('productDeleted',$this->_id);
        $this->resetInputFields();
    }

    public function render()
    {
        $products = Product::all()->reverse();
        return view('livewire.products',['products'=>$products])
                    ->extends('pages.products-page')
                    ->section('content');
    }
}
