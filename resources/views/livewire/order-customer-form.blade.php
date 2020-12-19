
<form>
    <div class="mb-3">
        <label for="code" class="form-label">Full Name</label>
        <input wire:model.lazy="name" type="text" class="form-control @error('name') border-danger @enderror" id="name" name="name" placeholder="Enter full name..." required>
        
        @error('name')
            <div class="form-text text-danger">{{$message}}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Phone</label>
        <input wire:model.lazy="phone" type="text" class="form-control @error('phone') border-danger @enderror" id="phone" name="phone" placeholder="Enter phone number..." required>

        @error('phone')
            <div class="form-text text-danger">{{$message}}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input wire:model.lazy="email" type="text" class="form-control @error('email') border-danger @enderror" id="price" name="email" placeholder="Enter product price ..." required>
        
        @error('email')
            <div class="form-text text-danger">{{$message}}</div>
        @enderror
    </div>
</form>