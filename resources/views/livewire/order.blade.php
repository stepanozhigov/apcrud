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
                                <li class="nav-item" >
                                  <a class="nav-link {{ $tab == 'order' ? 'active' : '' }}" wire:click.prevent="setTab('order')" href="#">Order</a>
                                </li>
                                <li class="nav-item" >
                                    <a class="nav-link {{ $tab == 'customer' ? 'active' : '' }}" wire:click.prevent="setTab('customer')" href="#">Customer</a>
                                  </li>
                                <li class="nav-item">
                                  <a class="nav-link {{ $tab == 'products' ? 'active' : '' }}"  wire:click.prevent="setTab('products')" href="#">Products</a>
                                </li>
                              </ul>


                              <div class="tab-content" id="myTabContent" >

                                {{-- ORDER TAB --}}
                                @if($tab == 'order')
                                <div class="tab-pane {{ $tab == 'order' ? 'fade show active' : 'fade' }}">

                                    <div class="my-4">
                                        <div class="card">
                                            <div class="card-header">
                                              Customer
                                            </div>
                                            <div class="card-body">

                                                {{-- CUSTOMER INFO --}}
                                                @if($customer)
                                                    <div class="card mb-3">
                                                        <div class="row g-0">
                                                            <div class="col-12">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">{{$customer->name}}</h5>
                                                                    <p class="card-text">{{$customer->phone}}</p>
                                                                    <p class="card-text"><small class="text-muted">{{$customer->email}}</small></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else 
                                                    <button type="button" class="btn btn-primary" wire:click.prevent="setTab('customer')">Select Customer</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="my-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex justify-content-between">
                                                    <span>Order Cart ({{count($cart)}})</span>
                                                    <span><b>{{$cart_total}} $</b></span>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                {{-- PRODUCTS TABLE: checkout list --}}
                                                @if($cart->count() > 0)
                                                    {{-- <livewire:products-order-table type="checkout" /> --}}
                                                @else   
                                                    <button type="button" class="btn btn-primary" wire:click.prevent="setTab('products')">
                                                        Select Products
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @if($cart->count() < 1 || !$customer) 
                                        <button type="button" class="btn btn-danger" disabled>Place Order</button>
                                    @else
                                        <button type="button" class="btn btn-primary" wire:click.prevent="store">Place Order</button>
                                    @endif
                                    


                                </div>
                                @endif

                                {{-- CUSTOMER TAB --}}
                                @if($tab == 'customer')
                                <div class="tab-pane {{ $tab == 'customer' ? 'fade show active' : 'fade' }}">

                                    
                                    <div class="my-4 {{ $customer ? 'd-none' : 'd-block'}}">
                                        <div class="card">
                                            <div class="card-header">
                                              New Customer
                                            </div>

                                            <div class="card-body">
                                                {{-- FORM --}}
                                                
                                                    @include('livewire.order-customer-form')
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="my-4">
                                        <div class="card">
                                            <div class="card-header">
                                              Choose Customer
                                            </div>
                                            <div class="card-body">
                                                {{-- CUSTOMER TABLE: customer select --}}
                                                <livewire:customers-table />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @endif

                                {{-- PRODUCTS --}}
                                @if($tab == 'products')
                                <div class="tab-pane {{ $tab == 'products' ? 'fade show active' : 'fade' }}">
                                    {{-- PRODUCTS TABLE: Add to order --}}
                                    <livewire:products-order-table type="cart" />
                                </div>
                                @endif
                              </div>
                               
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
