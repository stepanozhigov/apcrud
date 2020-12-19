<table class="table table-striped table-hover">
    <thead>
        <tr>
          @if($type == 'edit') <th scope="col">#</th> @endif
          @if($type == 'select') <th scope="col"></th> @endif
          <th scope="col">Code</th>
          <th scope="col">Name</th>
          <th scope="col">Price</th>
          <th scope="col">Edit</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($products as $product)
            <tr>
                @if ($type == 'edit') <th scope="row">{{$product->id}}</th> @endif
                @if($type == 'select')
                    <th scope="row">
                        <input type="checkbox" name="id[]">
                    </th>
                @endif
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
