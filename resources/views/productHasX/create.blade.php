@extends('index')

@section('title', 'New Sotrage')
@section('content')

<main class="row d-flex flex-column justify-content-center align-items-center">
    <h1 class="text-center my-4 w-100">Nuevo Almacenamiento</h1>
    
    @if ($errors->any())
        <div class="alert alert-warning w-100" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>    
        </div>
    @endif

    @if (isset($custom_error))
        <div class="alert alert-warning w-100" role="alert">
            <ul>
                <li>{{ $custom_error }}</li>
            </ul>
        </div>
    @endif

    <form action="{{ url('new-storage') }}" method="post" class="row d-flex flex-column justify-content-center align-items-center" style="max-width: 1000px;">

        @csrf

        <div class="mb-3">
            <label for="store" class="form-label">Almacén</label>
            <select class="form-select" name="store" id="store" required>
                <option value="" disabled selected>Selecciona un almacén</option>
                @foreach ($stores as $store)
                    <option value="{{ $store->storeId }}">{{ $store->storeId }}</option>
                @endforeach
            </select>
        </div>
        
        <!-- Product Select -->
        <div class="mb-3">
            <label for="product" class="form-label">Producto</label>
            <select class="form-select" name="product" id="product" required>
                <option value="" disabled selected>Selecciona un producto</option>
                @foreach ($products as $product)
                    <option value="{{ $product->productId }}">{{ $product->productId }}</option>
                @endforeach
            </select>
        </div>

        <!-- stock -->
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" min="0" max="1000" class="form-control" name="stock" id="stock" placeholder="Cantidad del producto" value="{{ old('stock') }}" required>
        </div>

        <div class="d-flex justify-content-center align-items-center gap-4 mt-4">
            <a href="{{ url('/#storages') }}" class="btn btn-secondary">Volver</a>
            <button id="create" type="submit" class="btn btn-primary">Registrar</button>
        </div>

    </form>

    <script>
        $(document).ready(function(){
            $('#create').click(function(e){
                $('form').submit();
                $(this).prop('disabled', true);
            });
        });
    </script>

</main>

@endsection