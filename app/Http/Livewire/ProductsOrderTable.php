<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductsOrderTable extends Component
{
    //db products
    public $products;
    //products for cart
    public $cart_products;
    //products selected for checkout
    public $cart;
    //type of table
    public $type;

    protected $listeners = [
        
    ];

    public function mount() {
        $this->getSessionCart();
        $this->getCartProducts();
    }

    public function getSessionCart() {
        $cart = session()->get('cart');

        if(is_array($cart)) {
            $this->cart = collect($cart);
        } else {
            $this->cart = collect([]);
        }
        // dd(session()->get('cart'));
    }

    public function getCartProducts() {
        $this->products = Product::orderBy('name')->get();
        $items = collect([]);
        $cart = $this->cart;
        // dd($cart);

        if($this->products->count() > 0) {
            $this->products->each(function ($product, $key) use ($items,$cart) {
                    $item = [
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'quantity' => 0,
                        'price' => $product->price,
                        'amount' => 0,
                    ];
                    $items->push($item);
            });
            $this->cart_products =  $items;
        }
    }

    public function getCartProductById($product_id) {
        return $this->cart_products->firstWhere('product_id',$product_id);
    }

    public function changeCart($action = 'add',$product_id) {

        //get item id in cart
        $cart_key = $this->cart->search(function($item,$i) use ($product_id) {
            return $product_id == $item['product_id'];
        });

        // dd($cart_key);
        // dd($this->cart);

        if(is_int($cart_key)) {
            //update existing
            // dd('existing');
            $item = $this->cart[$cart_key];
            if($action == 'add') {
                $item['quantity'] +=1;
            } else if($action == 'substract') {
                if($item['quantity'] > 0) {
                    $item['quantity'] -=1;
                }
            }
            $item['amount'] = $item['quantity']*$item['price'];
            $this->cart[$cart_key] = $item;
        } else {
            //add product to cart
            // dd('new');
            $item = $this->getCartProductById($product_id);
            $item['quantity'] +=1;
            $item['amount'] =$item['price']*$item['quantity'];
            $this->cart->push($item);
        }
        $this->cart->sortBy('name');

        //session
        // session()->forget('cart');
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
