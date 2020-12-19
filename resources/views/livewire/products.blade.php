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
                            <livewire:products-table type="edit" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
