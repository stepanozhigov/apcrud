<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductsTable extends Component
{
    public $type;
    public $_id;
    public $products;
    public $order_products = [];
    public $order_product_ids = [];

    protected $listeners = [
        'productCreated' => 'productCreatedCallback',
        'productUpdated' => 'productUpdatedCallback',
        'productDeleted' => 'productDeletedCallback',
        'addProductToOrder' => 'productAddedCallback',
        'removeProductFromOrder' => 'productRemovedCallback'
    ];

    public function mount($type = 'edit') {
        $this->type = $type;
        if($type == 'select') {
            $this->order_products = collect([]);
            $this->order_product_ids = collect([]);
            $this->getSessionOrderProducts();
        }
        
        $this->getProducts();
    }

    public function getSessionOrderProducts() {
        $session_ids = session()->get('order_product_ids');
        
        if(is_array($session_ids)) {
            $this->order_product_ids = collect(array_values($session_ids));
            $this->order_products = Product::whereIn('id',$session_ids)->orderBy('name')->get();
        }
    }

    public function getProducts() {
        if($this->type == 'edit') {
            $this->products = Product::all()->reverse();
        } elseif($this->type == 'select') {
            $this->products = Product::orderBy('name')->get();
            // dd($this->products);
        }
        elseif($this->type == 'view') {
            $this->products = Product::orderBy('name')->get();
        }
    }

    //EDIT

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

    //SELECT

    public function productAddedCallback(Product $product) {
        
        $this->order_product_ids = $this->order_product_ids->push($product->id);
        $this->order_products = $this->order_products->push($product);

        session()->put('order_product_ids',$this->order_product_ids->all());
    }

    public function productRemovedCallback(Product $product) {

        $this->order_product_ids = $this->order_product_ids->reject(function ($id,$i) use ($product) {
            return $product->id == $id;
        });

        $this->order_products = $this->order_products->reject(function ($item,$i) use ($product) {
            return $product->id == $item->id;
        });

        session()->put('order_product_ids',$this->order_product_ids->all());
    }

    public function render()
    {
        return view('livewire.products-table');
    }
}
