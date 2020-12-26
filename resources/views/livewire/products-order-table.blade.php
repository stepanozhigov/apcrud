@php
    // dd($type)    
@endphp

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Amount</th>
            <th scope="col">+/-</th>
            
        </tr>
    </thead>
    <tbody>
        @if($type == 'cart')
            @foreach ($cart_products as $item)
                <tr>
                    <td>{{$item['name']}}</th>
                    <td>{{$item['quantity']}}</td>
                    <td>{{$item['price']}}</td>
                    <td>{{$item['amount']}}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button wire:click.prevent = "addToCart({{$item['product_id']}})" type="button" class="btn btn-warning mx-1">Add</button>
                            @if($item['quantity'] > 0) <button  wire:click.prevent = "removeFromCart({{$item['product_id']}})" type="button" class="btn btn-danger mx-1">Remove</button> @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
  </table>
