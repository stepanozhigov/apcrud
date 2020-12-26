<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Order as ProductsOrder;
use App\Models\OrderedProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\Component;

class Order extends Component
{
    public $customer;
    public $cart;
    public $cart_total;
    public $tab = 'products';


    protected $listeners = [
        //'cartUpdatedEvent' => 'cartUpdatedCallback',
        'customerSelected' => 'customerSelectedCallback',
        'customerCleared' => 'customerClearedCallback'
    ];

    public function mount() {
        $this->setSessionCustomer();
        $this->setSessionOrderProducts();
        $this->setCartTotal();
    }

    public function setSessionOrderProducts() {
        $cart = session()->get('cart');
        if($cart) {
            $this->cart = collect($cart);
            
        } else {
            $this->cart = collect([]);
        }
        //dd($this->cart);
    }

    public function setSessionCustomer() {
        $this->selected_customer_id = session()->get('selected_customer_id');
        
        if($this->selected_customer_id) {
            $this->customer = Customer::find($this->selected_customer_id);
        } else {
            $this->customer = null;
        }
    }

    public function setCartTotal() {
        $total = $this->cart->reduce(function ($total, $product) {
            return $total + $product['amount'];
        }, 0);
        $this->cart_total = $total;
    }

    public function setTab($tabName) {
        $this->tab = $tabName;
    }

    public function cartUpdatedCallback($ids) {
        $this->cart = Product::whereIn('id',array_values($ids))->orderBy('name')->get();
    }

    public function customerSelectedCallback(Customer $customer) {
        $this->customer = $customer;
    }

    public function customerClearedCallback(Customer $customer) {
        $this->customer = null;

    }

    public function store() {
        $total = $this->cart->reduce(function ($total, $product) {
            return $total + $product->price;
        }, 0);
        $order = ProductsOrder::create([
            'number' => uniqid(),
            'amount' => $total*100,
            'customer_id' => $this->customer->id
        ]);

        //CREATE ORDERED PRODUCTS FROM CART

        $this->cart->each(function ($product, $key) use ($order) {
            // dd($product);
            // dd($product->only(['number', 'amount']));
            $ordered_product = OrderedProduct::create($product->only(['number', 'amount']));
            $order->ordered_products()->save($ordered_product);
            $ordered_product->product()->associate($product);
            $ordered_product->save();
        });



        // $product = Product::create($data);
        // $this->emit('productCreated',$product->id);
        // $this->resetInputFields();
    }


    public function render()
    {
        // dd($this->cart);
        return view('livewire.order')->extends('pages.order-page')->section('content');
    }
}
