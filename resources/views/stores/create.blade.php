@extends('index')

@section('title', 'New Store')
@section('content')

<main class="row d-flex flex-column justify-content-center align-items-center">
    <h1 class="text-center my-4 w-100">Nuevo Almacén</h1>
    
    @if ($errors->any())
        <div class="alert alert-warning w-100" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>    
        </div>
    @endif

    <form action="{{ url('new-store') }}" method="post" class="row d-flex flex-column justify-content-center align-items-center" style="max-width: 1000px;">

        @csrf
    
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nombre de la categoría" value="{{ old('name') }}" required>
        </div>
        
        <div class="d-flex justify-content-center align-items-center gap-4 mt-4">
            <a href="{{ url('/#stores') }}" class="btn btn-secondary">Volver</a>
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