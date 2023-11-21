@extends('index')

@section('title', 'Home')
@section('content')

<main class="position-relative row d-flex flex-column justify-content-center align-items-center">
    <h1 class="text-center my-4 w-100">CRUD Tca-Tik</h1>
    
    <!-- Products -->
    <h2 id="products" class="text-center mb-3 w-100">Productos</h2>
    <a href="{{ url('new-product') }}" class="btn btn-primary btn-sm mb-5 p-2" style="width: 190px;">
        <i class="fas fa-plus me-1"></i>
        Nuevo producto
    </a>
    <div class="table-responsive" style="max-width: 1200px; min-height: 90vh;">
        <table class="table bg-black">
            <thead class="text-white">
                <tr>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">PRECIO</th>
                    <th scope="col">CATEGORÍA</th>
                    <th scope="col">OBSERVACIONES</th>
                    <th scope="col" class="text-center">OPCIONES</th>
                </tr>
            </thead>
            <tbody class="bg-white h-100">
                @foreach($products as $product)
                <tr>
                    <td> {{ $product->name }} </td>
                    <td> {{ $product->price }} </td>
                    <td> {{ $product->categoryId }} </td>
                    <td> {{ $product->observations }} </td>
                    <td style="width: 120px;">
                        <div class="d-flex justify-content-around gap-2">
                            <a href="{{ url('edit-product/' . $product->productId) }}" class="btn btn-success text-white">
                                <i class="fas fa-edit"src=""></i>
                            </a>
                            <a href="{{ url('delete-product/' . $product->productId) }}" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Categories -->
    <h2 id="categories" class="text-center my-5 w-100">Categorías</h2>
    <a href="{{ url('new-category') }}" class="btn btn-primary btn-sm mb-5 p-2" style="width: 190px;">
        <i class="fas fa-plus me-1"></i>
        Nueva categoría
    </a>
    <div class="table-responsive" style="max-width: 1200px; min-height: 90vh;">
        <table class="table bg-black">
            <thead class="text-white">
                <tr>
                    <th scope="col">CATEGORÍA</th>
                    <th scope="col" class="text-center">OPCIONES</th>
                </tr>
            </thead>
            <tbody class="bg-white h-100">
                @foreach($categories as $category)
                <tr>
                    <td scope="row">{{ $category->categoryId }}</td>
                    <td style="width: 120px;">
                        <div class="d-flex justify-content-around gap-2">
                            <a href="{{ url('edit-category/' . $category->categoryId) }}" class="btn btn-success text-white">
                                <i class="fas fa-edit"src=""></i>
                            </a>
                            <a href="{{ url('delete-category/' . $category->categoryId) }}" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Stores -->
    <h2 id="stores" class="text-center my-5 w-100">Almacenes</h2>
    <a href="{{ url('new-store') }}" class="btn btn-primary btn-sm mb-5 p-2" style="width: 190px;">
        <i class="fas fa-plus me-1"></i>
        Nuevo Almacén
    </a>
    <div class="table-responsive" style="max-width: 1200px; min-height: 90vh;">
        <table class="table bg-black">
            <thead class="text-white">
                <tr>
                    <th scope="col">NOMBRE</th>
                    <th scope="col" class="text-center">OPCIONES</th>
                </tr>
            </thead>
            <tbody class="bg-white h-100">
                @foreach($stores as $store)
                <tr>
                    <td scope="row">{{ $store->name }}</td>
                    <td style="width: 120px;">
                        <div class="d-flex justify-content-around gap-2">
                            <a href="{{ url('edit-store/' . $store->storeId) }}" class="btn btn-success text-white">
                                <i class="fas fa-edit"src=""></i>
                            </a>
                            <a href="{{ url('delete-store/' . $store->storeId) }}" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Storages -->
    <h2 id="storages" class="text-center my-5 w-100">Almacenamientos</h2>
    <a href="{{ url('new-storage') }}" class="btn btn-primary btn-sm mb-5 p-2" style="width: 190px;">
        <i class="fas fa-plus me-1"></i>
        Nuevo Almacenamiento
    </a>
    <div class="table-responsive mb-5" style="max-width: 1200px; min-height: 90vh;">
        <table class="table bg-black">
            <thead class="text-white">
                <tr>
                    <th scope="col">ALMACEN</th>
                    <th scope="col">PRODUCTO</th>
                    <th scope="col">STOCK</th>
                    <th scope="col" class="text-center">OPCIONES</th>
                </tr>
            </thead>
            <tbody class="bg-white h-100">
                @foreach($ProductHasX as $productStore)
                <tr>
                    <td scope="row">{{ $productStore->storeId }}</td>
                    <td scope="row">{{ $productStore->productId }}</td>
                    <td scope="row">{{ $productStore->stock }}</td>
                    <td style="width: 120px;">
                        <div class="d-flex justify-content-around gap-2">
                            <!-- poduct id + store id in url param "store = . . ."-->
                            <a href="{{ url('edit-storage/' . $productStore->productStoreId) }}" class="btn btn-success text-white">
                                <i class="fas fa-edit"src=""></i>
                            </a>
                            <a href="{{ url('delete-storage/' . $productStore->productStoreId) }}" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Menu -->
    <ul class="position-fixed start-50 translate-middle bg-light p-4 d-flex justify-content-center gap-4 rounded border" style="width: 360px; list-style: none; top: 92%;">
        <li>
            <a class="btn btn-light btn-lg" href="/#products">
                <i class="fa-solid fa-box" style="transform: scale(1.4);"></i>
            </a>
        </li>
        <li>
            <a class="btn btn-light btn-lg" href="/#categories">
                <i class="fa-solid fa-tag" style="transform: scale(1.4);"></i>
            </a>
        </li>
        <li>
            <a class="btn btn-light btn-lg" href="/#stores">
                <i class="fa-solid fa-warehouse" scale="100" style="transform: scale(1.2);"></i>
            </a>
        </li>
        <li>
            <a class="btn btn-light btn-lg" href="/#storages">
                <i class="fa-solid fa-truck-fast" style="transform: scale(1.3);"></i>
            </a>
        </li>
    </ul>

</main>

@endsection