<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductsOrderTable extends Component
{
    //products
    public $products;
    //cart
    public $cart;
    //type of table
    public $type;
    //current page
    public $currentPage = 1;
    //models on page
    public $onPage = 15;
    //pages (count)
    public $pages = 0;
    //search (name)
    public $searchTerm;
    public $searchLabel = 'Search';

    protected $listeners = [
        'cartUpdated'=>'getTableProducts',
    ];

    public function mount() {
        // dd(session()->get('cart'));
        $this->getCart();
        $this->getTableProducts();
    }

    //go to previous page
    public function goToPrevPage() {
        // if() {
            $this->currentPage -= 1;
            $this->getTableProducts();
        // }
    }

    //go to next page
    public function goToNextPage() {
        // if() {
            $this->currentPage += 1;
            $this->getTableProducts();
        // }
    }

    //update search
    public function updatedSearchTerm() {
        //dd('updatedSearchTerm');
        $this->getTableProducts();
    }

    public function getCart() {
        $cart = session()->get('cart');

        if(is_array($cart)) {
            $this->cart = collect($cart);
        } else {
            $this->cart = collect([]);
        }
        // dd(session()->get('cart'));
    }

    public function getTableProducts($cart = false) {

        if(!$cart) {
            $cart = $this->cart;
        }

        //start select index
        $skip = $this->onPage * ($this->currentPage - 1);

        //get products from db
        if(!$this->searchTerm) {
            $products = Product::orderBy('name')->take($this->onPage)->skip($skip)->get();
            //unset search label
            $this->searchLabel = "Search";
        }
         //get search products grom db
        else {
            $products = Product::where('name','like','%'.$this->searchTerm.'%')->orderBy('name')->get();
            //set search label
            $this->searchLabel = 'Search complete ('.$products->count().' found)';
        }

        // if($products->count() > 0) {
            $cart_products = $products->map(function ($product, $key) use ($cart) {
                $item = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'quantity' => 0,
                    'price' => $product->price,
                    'amount' => 0,
                ];

                //check if item is in cart already and update quantity, amount
                //quantity from history, price and amount actual 
                $cart_item = $this->getCartItemByProductId($product->id);
                if($cart_item) {
                    $item['quantity'] =  $cart_item['quantity'];
                    $item['amount'] =  $item['quantity']*$product->price;
                }
                return $item;
            });

            //set transformed products to paginated data
            $this->products = $cart_products;

            // dd($this->products);
        // }
    }

    public function getProductById($product_id) {
        //dd($this->products);
        return $this->products->firstWhere('product_id',$product_id);
    }

    public function getCartItemByProductId($product_id) {
        return $this->cart->firstWhere('product_id',$product_id);
    }

    //add, substract,clear
    public function changeCart($action = 'add',$product_id) {

        //get item id in cart
        $cart_key = $this->cart->search(function($item,$i) use ($product_id) {
            return $product_id == $item['product_id'];
        });

        if(is_int($cart_key)) {
            
            //update existing
            $item = $this->cart[$cart_key];
            if($action == 'add') {
                $item['quantity'] +=1;
                $item['amount'] = $item['quantity']*$item['price'];
                $this->cart[$cart_key] = $item;
            } else if($action == 'substract') {
                if($item['quantity'] > 0) {
                    $item['quantity'] -=1;
                    $item['amount'] = $item['quantity']*$item['price'];
                    if($item['quantity'] > 0) {
                        $this->cart = $this->cart->replace([$cart_key=>$item]);
                    } else {
                        $this->cart = $this->cart->reject(function ($item, $key) use ($product_id) {
                            return $item['product_id'] == $product_id;
                        });
                    }
                } else {
                    $this->cart = $this->cart->reject(function ($item, $key) use ($product_id) {
                        return $item['product_id'] == $product_id;
                    });
                }
            } else if($action == 'clear') {
                if($item['quantity'] > 0) {
                    $this->cart = $this->cart->reject(function ($item, $key) use ($product_id) {
                        return $item['product_id'] == $product_id;
                    });
                }
            }
            
        } else {
            //add product to cart
            $item = $this->getProductById($product_id);
            $item['quantity'] +=1;
            $item['amount'] =$item['price']*$item['quantity'];
            $this->cart->push($item);
        }

        //sort cart alph
        $this->cart->sortBy('name');

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