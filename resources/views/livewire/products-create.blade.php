  
  <!-- Modal -->
  <div wire:ignore.self class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>

            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input wire:model.lazy="code" type="text" class="form-control @error('code') border-danger @enderror" id="code" name="code" placeholder="Enter product code ..." required>
                {{-- /border-danger --}}
                @error('code')
                    <div class="form-text text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input wire:model.lazy="name" type="text" class="form-control @error('name') border-danger @enderror" id="name" name="name" placeholder="Enter product name ..." required>

                @error('name')
                    <div class="form-text text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input wire:model.lazy="price" type="text" class="form-control @error('price') border-danger @enderror" id="price" name="price" placeholder="Enter product price ..." required>
                
                @error('price')
                    <div class="form-text text-danger">{{$message}}</div>
                @enderror
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" wire:click.prevent="store()">Add Product</button>
        </div>
      </div>
    </div>
  </div>