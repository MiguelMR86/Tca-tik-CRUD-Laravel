@extends('index')

@section('title', 'Edit Product')
@section('content')

<main class="row d-flex flex-column justify-content-center align-items-center">
    <h1 class="text-center my-4 w-100">Editar Producto</h1>
    
    @if ($errors->any())
        <div class="alert alert-warning w-100" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>    
        </div>
    @endif

    <form action="{{ url('edit-product/'.$product[0]->productId) }}" method="post" class="row d-flex flex-column justify-content-center align-items-center" style="max-width: 1000px;">
        @method('PUT')
        @csrf
    
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nombre del producto" value="{{ $product[0]->name }}" required>
        </div>
        
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" min="1" max="10000" step="any" class="form-control" name="price" id="price" placeholder="Precio de venta" value="{{ $product[0]->price }}" required>
        </div>
        
        <div class="mb-3">
            <label for="observations" class="form-label">Observaciones</label>
            <input type="text" class="form-control" name="observations" id="observations" placeholder="Observaciones y comentarios " value="{{ $product[0]->observations }}" required>
        </div>
        
        <div class="mb-3">
            <label for="category" class="form-label">Categoría</label>
            <select class="form-select" name="category" id="category" required>
                <option value="" disabled selected>Seleccionar categoría</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->categoryId }}" @if ($product[0]->categoryId == $category->categoryId) {{'selected'}} @endif >
                        {{ $category->categoryId }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="d-flex justify-content-center align-items-center gap-4 mt-4">
            <a href="{{ url('/#products') }}" class="btn btn-secondary">Volver</a>
            <button id="edit" type="submit" class="btn btn-success text-white">Editar</button>
        </div>

    </form>

    <script>
        $(document).ready(function(){
            $('#edit').click(function(e){
                $('form').submit();
                $(this).prop('disabled', true);
            });
        });
    </script>

</main>

@endsection