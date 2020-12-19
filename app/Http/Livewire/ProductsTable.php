<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductsTable extends Component
{
    public $type;
    public $_id;
    public $products;
    public $selected_products;

    protected $listeners = [
        'productCreated' => 'productCreatedCallback',
        'productUpdated' => 'productUpdatedCallback',
        'productDeleted' => 'productDeletedCallback'
    ];

    public function mount($type = 'edit') {
        $this->getProducts();
    }

    public function getProducts() {
        if($this->type == 'edit') {
            $this->products = Product::all()->reverse();
        } elseif($this->type == 'select') {
            $this->products = Product::orderBy('name')->select('code','name','price')->get();
        }
        elseif($this->type == 'view') {
            $this->products = Product::orderBy('name')->select('code','name','price')->get();
        }
    }

    public function productCreatedCallback(Product $product) {
        // dd($product);
        session()->flash('message',"Product '$product->name' created successfully");
        $this->getProducts();
    }

    public function productUpdatedCallback(Product $product) {
        session()->flash('message',"Product '$product->name' updated successfully");
        $this->getProducts();
    }

    public function productDeletedCallback() {
        $this->getProducts($this->type);
    }

    public function delete($id) {
        Product::destroy($id);
        // session()->flash('message',"Product deleted successfully");
        $this->getProducts($this->type);
    }

    public function render()
    {
        return view('livewire.products-table');
    }
}
