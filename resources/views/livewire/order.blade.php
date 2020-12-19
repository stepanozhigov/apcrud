<div>
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
                            <h3>Create Order</h3> 
                        </div>
                        <div class="card-body">
                           
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                  <a class="nav-link active" id="order-tab" data-bs-toggle="tab" href="#order" role="tab" aria-controls="order" aria-selected="true">Order</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <a class="nav-link" id="products-tab" data-bs-toggle="tab" href="#products" role="tab" aria-controls="products" aria-selected="false">Products</a>
                                </li>
                              </ul>
                              <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="order" role="tabpanel" aria-labelledby="order-tab">
                                    @include('livewire.order-customer-form')
                                </div>
                                <div class="tab-pane fade" id="products" role="tabpanel" aria-labelledby="products-tab">
                                    <livewire:products-table type="select" />
                                </div>
                              </div>
                               
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
