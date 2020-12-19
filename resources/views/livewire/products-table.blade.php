<table class="table table-striped table-hover">
    <thead>
        <tr>
          @if($type == 'edit') <th scope="col">#</th> @endif
          <th scope="col">Code</th>
          <th scope="col">Name</th>
          <th scope="col">Price</th>
          @if($type == 'edit') <th scope="col">Edit/Delete</th> @endif
          @if($type == 'select') <th scope="col">Add/Remove</th> @endif
        </tr>
      </thead>
      <tbody>
          @foreach ($products as $product)
            <tr>
                @if ($type == 'edit') <th scope="row">{{$product->id}}</th> @endif
                <td>{{$product->code}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>

                @if($type == 'edit')
                <td>
                    <div class="d-flex justify-content-center">
                        <button wire:click.prevent = "$emit('openProductEditModal',{{$product->id}})" type="button" class="btn btn-warning mx-1">Edit</button>
                        <button  wire:click.prevent = "delete({{$product->id}})" type="button" class="btn btn-danger mx-1">Delete</button>
                    </div>
                </td>
                @endif

                @if($type == 'select')
                <td>
                    <div class="d-flex justify-content-center">
                        @if(!$order_product_ids->contains($product->id))
                            <button 
                                wire:click.prevent="$emit('addProductToOrder',{{$product->id}})" type="button" class="btn btn-primary mx-1">Add
                            </button>
                        @else
                            <button
                                wire:click.prevent="$emit('removeProductFromOrder',{{$product->id}})" 
                                type="button" class="btn btn-secondary mx-1">Remove
                            </button>
                        @endif
                    </div>
                </td>
                @endif

            </tr>
          @endforeach
      </tbody>
  </table>
