<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductsTable extends Component
{
    public $type;
    public $_id;
    public $products;

    protected $listeners = [
        'productCreated' => 'productCreatedCallback',
        'productUpdated' => 'productUpdatedCallback',
        'productDeleted' => 'productDeletedCallback'
    ];

    public function mount($type = 'edit') {
        $this->type = $type;
        $this->getSessionOrderProductIds();
        $this->getProducts();

        $this->cart = collect([]);
    }

    public function getSessionOrderProductIds() {
        $session_ids = session()->get('order_product_ids');
        
        if(is_array($session_ids)) {
            $this->order_product_ids = collect(array_values($session_ids));
        } else {
            $this->order_product_ids = collect([]);
        }
    }

    public function getProducts() {
        $this->products = Product::all()->reverse();
    }

    //EDIT

    public function productCreatedCallback(Product $product) {
        // session()->flash('message',"Product '$product->name' created successfully");
        $this->getProducts();
    }

    public function productUpdatedCallback(Product $product) {
        // session()->flash('message',"Product '$product->name' updated successfully");
        $this->getProducts();
    }

    public function productDeletedCallback() {
        $this->getProducts($this->type);
    }

    public function delete($id) {
        Product::destroy($id);
        $this->getProducts($this->type);
    }

    public function render()
    {
        return view('livewire.products-table');
    }
}
