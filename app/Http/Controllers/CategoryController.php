<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /** 	
     * Validates product numeric Ids
     */
    public function validCategoryId($id)
    {
        if (!is_string($id)) {
            return false;
        }
        return true;
    }

    /**
     * Template for 404.
     */
    public function template404()
    {
        $msg = ['Category Not Found', 'Categoría No Encontrada', 'Error 404: La categoría que bucas no existe'];
        $url_back = '/#categories';
        $view = view("error", compact("msg", "url_back"));
        return $view;
    }
    
    /**
     * Show the form for creating a new category.
     */
    public function create_category()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store_category(Request $request)
    {
        $request->validate([
            "name" => "required|max:20|unique:categories,categoryId",
        ]);
        
        $category = new Category();
        $category->categoryId = $request->name;
        $category->timestamps = false;
        $category->save();
        
        $msg = ['Category Added','Categoría Añadida', 'Se ha registrado correctamente la categoría "' . $request->name . '"'];
        $url_back = '/#categories';

        return view("success", compact("msg", "url_back"));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit_category($id)
    {
        if (!$this->validCategoryId($id)) return $this->template404();
        
        $category = Category::where('categoryId', $id)->get();

        if ($category->count() == 0) return $this->template404();

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_category(Request $request, $categoryId)
    {
        if (!$this->validCategoryId($categoryId)) return $this->template404();

        $category = Category::where('categoryId', $categoryId);

        if ($category->count() == 0) return $this->template404();
        
        $request->validate([
            "name" => "required|max:20|unique:categories,categoryId",
        ]);

        $category->update([
            'categoryId' => $request->name
        ]);

        $msg = ['Category Edited','Categoría Editada', 'Se ha editado correctamente la categoría "' . $request->name . '"'];
        $url_back = '/#categories';
        return view("success", compact("msg", "url_back"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function delete_category($id)
    {
        if (!$this->validCategoryId($id)) return $this->template404();

        $category = Category::where('categoryId', $id)->get();

        if ($category->count() == 0) return $this->template404();

        $msg = ['Delete Category', 'Eliminar Categoría', 'Estas seguro de eliminar la categoría "' . $category[0]->categoryId . '"', 'Una vez eliminada, no podrás recuperar la información de dicha categoría.'];
        $path = 'delete-category/' . $id;
        $url_back = '/#categories';
        return view("delete", compact("msg", "path", "url_back"));
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy_category($id)
    {
        if (!$this->validCategoryId($id)) return $this->template404();
        
        $category = Category::where('categoryId', $id);
        
        if ($category->count() == 0) return $this->template404();

        $name = $category->get()[0]->categoryId;
        $category->delete();
        $msg = ['Category Deleted', 'Categoría eliminada', 'Se ha eliminado correctamente la categoría "' . $name . '"'];
        $url_back = '/#categories';
        return view("success", compact("msg", "url_back"));
    }
}
