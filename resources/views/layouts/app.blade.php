<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crud Application</title>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.1/css/pro.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    @yield('styles')
    @livewireStyles
</head>
<body class="bg-light">
    @yield('content')
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script
        src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
        crossorigin="anonymous">
    </script>
    @livewireScripts
    <script>
        $(function() {
            //create modal (bs5)
            const createProductEl = document.getElementById('createProductModal');
            const createProductModal = new bootstrap.Modal(createProductEl, {});

            window.livewire.on('productCreated',() => {
                    console.log('document event: productCreated');
                    createProductModal.hide();
                });

            //edit modal (bs5)
            const editProductEl = document.getElementById('editProductModal');
            const editProductModal = new bootstrap.Modal(editProductEl, {});

            window.livewire.on('openProductEditModal',() => {
                    console.log('document event: openProductEditModal');
                    editProductModal.show();
                });

            window.livewire.on('productUpdated',() => {
                    console.log('document event: productUpdated');
                    editProductModal.hide();
                });
            window.livewire.on('productDeleted',() => {
                console.log('document event: productDeleted');
                editProductModal.hide();
            });
        });
    </script>
</body>
</html>