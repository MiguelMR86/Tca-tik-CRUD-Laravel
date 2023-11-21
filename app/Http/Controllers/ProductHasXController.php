<?php

namespace App\Http\Controllers;

use App\Models\ProductHasX;
use App\Models\Product;
use App\Models\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductHasXController extends Controller
{
    /** 	
     * Validates product_has_x numeric Ids
     */
    public function validProductHasXId($id)
    {
        if (!is_numeric($id)) {
            return false;
        }
        return true;
    }

    /**
     * Template for 404.
     */
    public function template404()
    {
        $msg = ['Storage Not Found', 'Almacenamiento No Encontrado', 'Error 404: El almacenamiento que bucas no existe'];
        $url_back = '/#storages';
        $view = view("error", compact("msg", "url_back"));
        return $view;
    }
    /**
     * Show the form for creating a new productstore.
     */
    public function create_productstore()
    {
        $products = Product::all();
        $stores = Store::all();
        // Returns products & stores names instead of ids ( Products & Stores Table)
        foreach ($products as $product) $product->productId = $product->name;
        foreach ($stores as $store) $store->storeId = $store->name;

        return view('productHasX.create', compact('products', 'stores'));
    }

    /**
     * Store a newly created productstore in storage.
     */
    public function store_productstore(Request $request)
    {
        // Lists of products & stores names
        $products_names = array();
        foreach (Product::all() as $product) array_push($products_names, $product->name);
        $products_names = implode(",", $products_names);

        $stores_names = array();
        foreach (Store::all() as $store) array_push($stores_names, $store->name);
        $stores_names = implode(",", $stores_names);
        
        $request->validate([
            // unique primary key
            "product" => "required|in:$products_names",
            "store" => "required|in:$stores_names",
            "stock" => "required|numeric|between:1,1000",
        ]);          

        $productId = Product::where('name', $request->product)->get()[0]->productId;
        $storeId = Store::where('name', $request->store)->get()[0]->storeId;

        $ProductHasX = new ProductHasX();
        $ProductHasX->productId = $productId;
        $ProductHasX->storeId =  $storeId;
        $ProductHasX->stock = $request->stock;

        // If the product is already in the store throw an error
        if (ProductHasX::where('productId', $productId)->where('storeId', $storeId)->get()->count() > 0) {
            $custom_error = 'The product "' . $request->product . '" is already in the store "' . $request->store . '"';
            $products = Product::all();
            $stores = Store::all();
            // Returns products & stores names instead of ids ( Products & Stores Tables )
            foreach ($products as $product) $product->productId = $product->name;
            foreach ($stores as $store) $store->storeId = $store->name;
            $url_back = '/#storages';
            return view("productHasX.create", compact("custom_error", "products", "stores", "url_back"));
        }

        $ProductHasX->save();
        
        $msg = ['Storage Added','Almacenamiento Añadido', 'Se ha registrado correctamente el almacenamiento "' . $request->product . '" en el almacén "' . $request->store . '"'];
        $url_back = '/#storages';
        return view("success", compact("msg", "url_back"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_productstore($id)
    {
        $products = Product::all();
        $stores = Store::all();

        // Returns products & stores names instead of ids ( Products & Stores Table)
        foreach ($products as $product) $product->productId = $product->name;
        foreach ($stores as $store) $store->storeId = $store->name;    
        
        if (!$this->validProductHasXId($id)) return $this->template404();

        $ProductHasX = ProductHasX::where('productStoreId', $id)->get();

        if ($ProductHasX->count() == 0) return $this->template404();

        $product = Product::where('productId', $ProductHasX[0]->productId)->get();
        $store = Store::where('storeId', $ProductHasX[0]->storeId)->get();

        if ($product->count() == 0 || $store->count() == 0) return $this->template404();

        $ProductHasX[0]->productId = $product[0]->name;
        $ProductHasX[0]->storeId = $store[0]->name;

        return view('productHasX.edit', compact('ProductHasX', 'products', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_productstore(Request $request, $id)
    {
        if (!$this->validProductHasXId($id)) return $this->template404();
        
        $ProductHasX = ProductHasX::where('productStoreId', $id);

        if ($ProductHasX->count() == 0) return $this->template404();

        $products = Product::all();
        $stores = Store::all();

        // List of products & stores names
        $products_names = array();
        foreach (Product::all() as $product) array_push($products_names, $product->name);
        $products_names = implode(",", $products_names);

        $stores_names = array();
        foreach (Store::all() as $store) array_push($stores_names, $store->name);
        $stores_names = implode(",", $stores_names);
        
        $request->validate([
            // unique primary key
            "product" => "required|in:$products_names",
            "store" => "required|in:$stores_names",
            "stock" => "required|numeric|between:1,1000",
        ]);

        $productId = Product::where('name', $request->product)->get()[0]->productId;
        $storeId = Store::where('name', $request->store)->get()[0]->storeId;

        if (!$this->validProductHasXId($productId) || !$this->validProductHasXId($storeId)) return $this->template404();

        $auxProductHasX = ProductHasX::where('productId', $productId)->where('storeId', $storeId)->get();

        // If the product is already in the store throw an error
        if ($auxProductHasX->count() > 0 && $auxProductHasX[0]->productStoreId != $id) {
            $custom_error = 'The product "' . $request->product . '" is already in the store "' . $request->store . '"';
            $ProductHasX = ProductHasX::where('productStoreId', $id)->get();
            $product = Product::where('productId', $ProductHasX[0]->productId)->get();
            $store = Store::where('storeId', $ProductHasX[0]->storeId)->get();
            $ProductHasX[0]->productId = $product[0]->name;
            $ProductHasX[0]->storeId = $store[0]->name;
            
            // Returns products & stores names instead of ids ( Products & Stores Table)
            foreach ($products as $product) $product->productId = $product->name;
            foreach ($stores as $store) $store->storeId = $store->name;
            $url_back = '/#storages';
            return view("productHasX.edit", compact("custom_error", "products", "stores", "ProductHasX", "url_back"));
        }

        $ProductHasX->update([
            'productId' => $productId,
            'storeId' => $storeId,
            'stock' => $request->stock
        ]);

        $msg = ['Storage Edited','Almacenamiento Editado', 'Se ha editado correctamente el almacenamiento de "' . $request->product . '" en el almacén "' . $request->store . '"'];
        $url_back = '/#storages';

        return view("success", compact("msg", "url_back"));
    }

    /**
     * Show the delete form for the specified resource.
     */
    public function delete_productstore($id)
    {
        if (!$this->validProductHasXId($id)) return $this->template404();

        $ProductHasX = ProductHasX::where('productStoreId', $id)->get();
     
        if ($ProductHasX->count() == 0) return $this->template404();

        $product = Product::where('productId', $ProductHasX[0]->productId)->get();
        $store = Store::where('storeId', $ProductHasX[0]->storeId)->get();

        if ($product->count() == 0 || $store->count() == 0) return $this->template404();

        $msg = ['Delete Storage', 'Eliminar Almacenamiento', 'Estas seguro de eliminar el almacenamiento de "' . $product[0]->name . '" en el almacén "' . $store[0]->name . '"', 'Una vez eliminado, no podrás recuperar la información de dicho almacenamiento.'];
        $path = 'delete-storage/' . $id;
        $url_back = '/#storages';

        return view("delete", compact("msg", "path", "url_back"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_productstore($id)
    {
        if (!$this->validProductHasXId($id)) return $this->template404();

        $ProductHasX = ProductHasX::where('productStoreId', $id);

        if ($ProductHasX->count() == 0) return $this->template404();

        $product = Product::where('productId', $ProductHasX->get()[0]->productId)->get();
        $store = Store::where('storeId', $ProductHasX->get()[0]->storeId)->get();
        
        if ($product->count() == 0) return $this->template404();
        
        $ProductHasX->delete();

        $msg = ['Storage Deleted', 'Almacenamiento eliminado', 'Se ha eliminado correctamente el almacenamiento de "' . $product[0]->name . '" en el almacén "' . $store[0]->name . '"'];
        $url_back = '/#storages';
        
        return view("success", compact("msg", "url_back"));
    }
}
