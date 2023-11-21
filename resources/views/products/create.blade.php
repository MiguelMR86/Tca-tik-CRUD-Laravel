@extends('index')

@section('title', 'New Product')
@section('content')

<main class="row d-flex flex-column justify-content-center align-items-center">
    <h1 class="text-center my-4 w-100">Nuevo Producto</h1>
    
    @if ($errors->any())
        <div class="alert alert-warning w-100" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>    
        </div>
    @endif

    <form action="{{ url('new-product') }}" method="post" class="row d-flex flex-column justify-content-center align-items-center" style="max-width: 1000px;">

        @csrf
    
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nombre del producto" value="{{ old('name') }}" required>
        </div>
        
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" min="1" max="10000" step="any" class="form-control" name="price" id="price" placeholder="Precio de venta" value="{{ old('price') }}" required>
        </div>
        
        <div class="mb-3">
            <label for="observations" class="form-label">Observaciones</label>
            <input type="text" class="form-control" name="observations" id="observations" placeholder="Observaciones y comentarios " value="{{ old('observations') }}" required>
        </div>
        
        <div class="mb-3">
            <label for="category" class="form-label">Categoría</label>
            <select class="form-select" name="category" id="category" required>
                <option value="" disabled selected>Seleccionar categoría</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->categoryId }}">{{ $category->categoryId }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="d-flex justify-content-center align-items-center gap-4 mt-4">
            <a href="{{ url('/#products') }}" class="btn btn-secondary">Volver</a>
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