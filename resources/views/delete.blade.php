@extends('index')

@section('title', $msg[0])
@section('content')
<main class="row d-flex flex-column justify-content-center align-items-center px-5">
    <h1 class="text-center my-4 w-100">{{ $msg[1]}}</h1>

    @if ($errors->any())
        <div class="alert alert-warning w-100" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>    
        </div>
    @endif
    
    <form action="{{ url($path) }}" method="post" class="row d-flex flex-column justify-content-center align-items-center" style="max-width: 1000px;">
        @method('DELETE')
        @csrf
        <div class="text-center">
            <h3>
                ¿{{$msg[2]}}?
            </h3>
            <p>
                {{$msg[3]}}
            </p>
        </div>
        
        <div class="d-flex justify-content-center align-items-center gap-4 mt-4">
            <a href="{{ url($url_back) }}" class="btn btn-secondary">Volver</a>
            <button id="delete" type="submit" class="btn btn-danger">Eliminar</button>
        </div>
    </form>

    <script>
        $(document).ready(function(){
            $('#delete').click(function(e){
                $('form').submit();
                $(this).prop('disabled', true);
            });
        });
    </script>
</main>

@endsection