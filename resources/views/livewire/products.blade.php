<div>
    @include('livewire.products-create')
    <section class="my-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Products
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProductModal">Add New Product</button>
                            </h3>
                            
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
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
                                        <tr>
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
