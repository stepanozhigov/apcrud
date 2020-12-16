  
  <!-- Modal -->
  <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <input wire:model.lazy="code" type="text" class="form-control" id="code" name="code" placeholder="Enter product code ..." required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input wire:model.lazy="name" type="text" class="form-control" id="name" name="name" placeholder="Enter product name ..." required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input wire:model.lazy="price" type="text" class="form-control" id="price" name="price" placeholder="Enter product price ..." required>
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Add Product</button>
        </div>
      </div>
    </div>
  </div>