<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductsOrderTable extends Component
{
    public $products;
    //item [product_id=>name=>'quantity'=>,'price'=>,'amount'=>]
    public $cart = [];

    protected $listeners = [
        
    ];

    public function mount() {
        $this->getSessionCart();
    }

    public function getSessionCart() {
        $session_cart = session()->get('cart');
        
        if(is_array($session_cart)) {
            $this->cart = collect($session_cart);
        } else {
            $this->cart = $this->getProducts();
        }
    }

    public function getProducts() {
        $this->products = Product::orderBy('name')->get();
        $cart = collect([]);

        if($this->products->count() > 0) {
            $this->products->each(function ($product, $key) use ($cart) {
                    $item = [
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'quantity' => 0,
                        'price' => $product->price,
                        'amount' => 0,
                    ];
                    $cart->push($item);
                });
            }
            $this->cart = $cart;
    }

    //SELECT

    public function addToCart(Product $product) {

        //get item id in cart
        $cart_key = $this->cart->search(function($item,$i) use ($product) {
            return $product->id == $item['product_id'];
        });
        
        //update
        $item = $this->cart[$cart_key];
        $item['quantity'] +=1;
        $item['amount'] = $item['quantity']*$item['price'];
        $this->cart[$cart_key] = $item;

        //session
        session()->put('cart',$this->cart->all());

        //event
        $this->emit('cartUpdated',$this->cart);
    }

    public function removeFromCart(Product $product) {

        //get item id in cart
        $cart_key = $this->cart->search(function($item,$i) use ($product) {
            return $product->id == $item['product_id'];
        });
        
        //update
        $item = $this->cart[$cart_key];
        $item['quantity'] -=1;
        $item['amount'] = $item['quantity']*$item['price'];
        $this->cart[$cart_key] = $item;

        //session
        session()->put('cart',$this->cart->all());

        //event
        $this->emit('cartUpdated',$this->cart);
    }

    public function render()
    {
        //dd($this->cart);
        return view('livewire.products-order-table');
    }
}
