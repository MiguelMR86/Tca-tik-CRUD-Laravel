@extends('index')

@section('title', $msg[0])
@section('content')

<main class="row d-flex flex-column justify-content-center align-items-center">
    <h1 class="text-center my-4 w-100">{{ $msg[1] }}</h1>
    
    <div class="px-2">
        <div class="alert alert-success w-100 " role="alert">
            {{ $msg[2] }}
        </div>
    </div>
    <a href="{{ url($url_back) }}" class="btn btn-primary mb-4" style="width: 150px;">
        Regresar
    </a>
</main>

@endsection