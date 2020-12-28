@php
    // dd($type)    
@endphp
<div class="product-order-table">
    <div class="input-group mt-4">
        <span class="input-group-text" id="basic-addon1">{{$searchLabel}}</span>
        <input wire:model.lazy="searchTerm" type="text" class="form-control" placeholder="Product name..." aria-label="Username">
    </div>
    <table class="table table-striped table-hover mt-4">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Amount</th>
                @if($type == 'cart')
                    <th scope="col">+/-/Clear</th>
                @elseif($type == 'checkout')
                    <th scope="col">Clear</th>
                @endif
            </tr>
        </thead>
        <tbody>
            {{-- CART --}}
            @if($type == 'cart')
                @foreach ($cart_products as $item)
                    <tr>
                        <td>{{$item['name']}}</th>
                        <td>{{$item['quantity']}}</td>
                        <td>{{$item['price']}}</td>
                        <td>{{$item['amount']}}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <button wire:click.prevent = "changeCart('add',{{$item['product_id']}})" type="button" class="btn btn-success mx-1">
                                    <i class="far fa-plus-square"></i>
                                </button>
                                @if($item['quantity'] > 0)
                                    <button  wire:click.prevent = "changeCart('substract',{{$item['product_id']}})" type="button" class="btn btn-warning mx-1">
                                        <i class="far fa-minus-square"></i>
                                    </button>
                                @endif
                                @if($item['quantity'] > 0)
                                    <button  wire:click.prevent = "changeCart('clear',{{$item['product_id']}})" type="button" class="btn btn-danger mx-1">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            {{-- CHECKOUT --}}    
            @elseif('checkout')
                @foreach ($cart as $item)
                    <tr>
                        <td>{{$item['name']}}</th>
                        <td>{{$item['quantity']}}</td>
                        <td>{{$item['price']}}</td>
                        <td>{{$item['amount']}}</td>
                        <td>
                            <button  wire:click.prevent = "changeCart('clear',{{$item['product_id']}})" type="button" class="btn btn-danger mx-1">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
