<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /** 	
     * Validates store numeric Ids
     */
    public function validStoreId($id)
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
        $msg = ['Store Not Found', 'Almacén No Encontrado', 'Error 404: El almacén que bucas no existe'];
        $url_back = '/#stores';
        $view = view("error", compact("msg", "url_back"));
        return $view;
    }

    /**
     * Show the form for creating a new store.
     */
    public function create_store()
    {
        return view('stores.create');
    }

    /**
     * Store a newly created store in storage.
     */
    public function store_store(Request $request)
    {
        $request->validate([
            "name" => "required|min:3|max:100|unique:stores,name",
        ]);
        
        $store = new Store();
        $store->name = $request->name;
        $store->timestamps = false;
        $store->save();
        
        $msg = ['Store Added','Almacén Añadido', 'Se ha registrado correctamente el almacén "' . $request->name . '"'];
        $url_back = '/#stores';

        return view("success", compact("msg", "url_back"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_store($id)
    {
        if (!$this->validStoreId($id)) return $this->template404();        

        $store = Store::where('storeId', $id)->get();

        if ($store->count() == 0) return $this->template404();

        return view('stores.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_store(Request $request, $storeId)
    {
        if (!$this->validStoreId($storeId)) return $this->template404();

        $store = Store::where('storeId', $storeId);

        if ($store->count() == 0) return $this->template404();
        
        $request->validate([
            "name" => "required|max:100|unique:stores,name,$storeId,storeId",
        ]);

        $store->update([
            'name' => $request->name
        ]);

        $msg = ['Store Edited','Almacén Editado', 'Se ha editado correctamente el almacén "' . $request->name . '"'];
        $url_back = '/#stores';
        return view("success", compact("msg", "url_back"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function delete_store($id)
    {
        if (!$this->validStoreId($id)) return $this->template404();

        $store = Store::where('storeId', $id)->get();

        if ($store->count() == 0) return $this->template404();

        $msg = ['Delete Store', 'Eliminar Almacén', 'Estas seguro de eliminar el almacén "' . $store[0]->name . '"', 'Una vez eliminado, no podrás recuperar la información de dicho almacén.'];
        $path = 'delete-store/' . $id;
        $url_back = '/#stores';

        return view("delete", compact("msg", "path", "url_back"));
    }
    public function destroy_store($id)
    {
        if (!$this->validStoreId($id)) return $this->template404();

        $store = Store::where('storeId', $id);

        if ($store->count() == 0) return $this->template404();

        $name = $store->get()[0]->name;
        $store->delete();

        $msg = ['Store Deleted', 'Almacén eliminado', 'Se ha eliminado correctamente el almacén "' . $name . '"'];
        $url_back = '/#stores';
        
        return view("success", compact("msg", "url_back"));
    }
}
