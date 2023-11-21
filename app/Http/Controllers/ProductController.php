<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /** 	
     * Validates product numeric Ids
     */
    public function validProductId($id)
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
        $msg = ['Product Not Found', 'Producto No Encontrado', 'Error 404: El producto que bucas no existe'];
        $url_back = '/#products';
        $view = view("error", compact("msg", "url_back"));
        return $view;
    }

    /**
     * Show the form for creating a new product.
     */
    public function create_product()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store_product(Request $request)
    {   
        $request->validate([
            "name" => "required|min:3|max:100|unique:products,name",
            "price" => "required|numeric|between:1,10000|regex:/^\d+(\.\d{1,2})?$/",
            "observations" => "required|max:255",
            "category" => "required|max:20|unique:categories,categoryId,$request->category,categoryId",
        ]);
        
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->observations = $request->observations;
        $product->categoryId = $request->category;
        $product->timestamps = false;
        $product->save();
        
        $msg = ['Product Added','Producto Añadido', 'Se ha registrado correctamente el producto "' . $request->name . '"'];
        $url_back = '/#products';
        
        return view("success", compact("msg", "url_back"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_product($id)
    {
        if (!$this->validProductId($id)) return $this->template404();

        $product = Product::where('productId', $id)->get();
        $categories = Category::all();
        
        if ($product->count() == 0) return $this->template404();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_product(Request $request, $id)
    {
        if (!$this->validProductId($id)) return $this->template404();

        $product = Product::where('productId', $id);
        
        if ($product->count() == 0) return $this->template404();
        
        $request->validate([
            "name" => "required|min:3|max:100|unique:products,name,$id,productId",
            "price" => "required|numeric|between:1,10000|regex:/^\d+(\.\d{1,2})?$/",
            "observations" => "required|max:255",
            "category" => "required|max:20|unique:categories,categoryId,$request->category,categoryId",
        ]);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'observations' => $request->observations,
            'categoryId' => $request->category
        ]);

        $msg = ['Product Edited','Producto Editado', 'Se ha editado correctamente el producto "' . $request->name . '"'];
        $url_back = '/#products';
        
        return view("success", compact("msg", "url_back"));
    }

    /**
     * Show the delete form for the specified resource.
     */
    public function delete_product($id)
    {
        if (!$this->validProductId($id)) return $this->template404();
        
        $product = Product::where('productId', $id)->get();
        
        if ($product->count() == 0) return $this->template404();

        $msg = ['Delete Product', 'Eliminar Producto', 'Estas seguro de eliminar el producto "' . $product[0]->name . '"', 'Una vez eliminado, no podrás recuperar la información de dicho producto.'];
        $path = 'delete-product/' . $id;
        $url_back = '/#products';
        
        return view("delete", compact("msg", "path", "url_back"));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy_product($id)
    {
        if (!$this->validProductId($id)) return $this->template404();

        $product = Product::where('productId', $id);

        if ($product->count() == 0) return $this->template404();

        $name = $product->get()[0]->name;
        $product->delete();
        
        $msg = ['Product Deleted', 'Producto eliminado', 'Se ha eliminado correctamente el producto "' . $name . '"'];
        $url_back = '/#products';
        
        return view("success", compact("msg", "url_back"));
    }
}
