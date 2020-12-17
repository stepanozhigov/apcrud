<div>
    @include('livewire.products-create')
    @include('livewire.products-edit')
    <section class="my-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if(session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('message')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3>Products
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProductModal">Add New Product</button>
                            </h3>
                            
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Code</th>
                                      <th scope="col">Name</th>
                                      <th scope="col">Price</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($products as $product)
                                        <tr wire:click.prevent = "$emit('openProductEditModal',{{$product->id}})">
                                            <th scope="row">{{$product->id}}</th>
                                            <td>{{$product->code}}</td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->price}}</td>
                                        </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
