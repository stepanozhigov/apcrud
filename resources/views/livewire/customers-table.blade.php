<table class="table table-striped table-hover">
    <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Phone</th>
          <th scope="col">Email</th>
          <th scope="col">Select/Clear</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($customers as $customer)
            <tr wire:key="{{$customer->id}}" class="{{$selected_customer_id && $selected_customer_id != $customer->id ? 'd-none' : ''}}">
                <td>{{$customer->name}}</td>
                <td>{{$customer->phone}}</td>
                <td>{{$customer->email}}</td>
                <td>
                    <div class="d-flex justify-content-center">
                        @if($selected_customer_id != $customer->id)
                            <button 
                                wire:click.prevent="selectCustomer({{$customer->id}})" type="button" class="btn btn-primary mx-1">Select
                            </button>
                        @else
                            <button
                                wire:click.prevent="clearCustomer({{$customer->id}})" 
                                type="button" class="btn btn-secondary mx-1">Unselect
                            </button>
                        @endif
                    </div>
                </td>

            </tr>
          @endforeach
      </tbody>
  </table>
