<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Code</th>
            <th scope="col">Price</th>
            <th scope="col">Edit/Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <th scope="row">{{$product->id}}</th>
                <td>{{$product->code}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>
                
                <td>
                    <div class="d-flex justify-content-center">
                        <button wire:click.prevent = "$emit('openProductEditModal',{{$product->id}})" type="button" class="btn btn-warning mx-1">Edit</button>
                        <button  wire:click.prevent = "delete({{$product->id}})" type="button" class="btn btn-danger mx-1">Delete</button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
