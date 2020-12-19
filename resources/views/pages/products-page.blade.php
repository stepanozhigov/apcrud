@extends('layouts.app')

@push('scripts')
    <script>
        $(function() {
            //create modal (bs5)
            const createProductEl = document.getElementById('createProductModal');
            if(createProductEl) {
                const createProductModal = new bootstrap.Modal(createProductEl, {});

                window.livewire.on('productCreated',() => {
                        console.log('document event: productCreated');
                        createProductModal.hide();
                    });
            }

            //edit modal (bs5)
            const editProductEl = document.getElementById('editProductModal');
            if(editProductEl) {
                const editProductModal = new bootstrap.Modal(editProductEl, {});

                window.livewire.on('openProductEditModal',() => {
                        console.log('document event: openProductEditModal');
                        editProductModal.show();
                    });
                window.livewire.on('closeProductEditModal',() => {
                        console.log('document event: closeProductEditModal');
                        editProductModal.hide();
                    });

                window.livewire.on('productUpdated',() => {
                        console.log('document event: productUpdated');
                        editProductModal.hide();
                    });
                window.livewire.on('productDeleted',() => {
                    console.log('document event: productDeleted');
                    editProductModal.hide();
                });
            }
        });
    </script>
@endpush