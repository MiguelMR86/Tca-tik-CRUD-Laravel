<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductHasXController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// GENERAL
Route::get('/', [DatabaseController::class,'index']);

// PRODUCTS
Route::get('/new-product', [ProductController::class,'create_product']);
Route::post('/new-product', [ProductController::class,'store_product']);

Route::get('/edit-product/{id}', [ProductController::class,'edit_product']);
Route::put('/edit-product/{id}', [ProductController::class,'update_product']);

Route::get('/delete-product/{id}', [ProductController::class,'delete_product']);
Route::delete('/delete-product/{id}', [ProductController::class,'destroy_product']);

// CATEGORIES
Route::get('/new-category', [CategoryController::class,'create_category']);
Route::post('/new-category', [CategoryController::class,'store_category']);

Route::get('/edit-category/{id}', [CategoryController::class,'edit_category']);
Route::put('/edit-category/{id}', [CategoryController::class,'update_category']);

Route::get('/delete-category/{id}', [CategoryController::class,'delete_category']);
Route::delete('/delete-category/{id}', [CategoryController::class,'destroy_category']);

// STORES
Route::get('/new-store', [StoreController::class,'create_store']);
Route::post('/new-store', [StoreController::class,'store_store']);

Route::get('/edit-store/{id}', [StoreController::class,'edit_store']);
Route::put('/edit-store/{id}', [StoreController::class,'update_store']);

Route::get('/delete-store/{id}', [StoreController::class,'delete_store']);
Route::delete('/delete-store/{id}', [StoreController::class,'destroy_store']);

// PRODUCTS HAS X
Route::get('/new-storage', [ProductHasXController::class,'create_productstore']);
Route::post('/new-storage', [ProductHasXController::class,'store_productstore']);

Route::get('/edit-storage/{id}', [ProductHasXController::class,'edit_productstore']);
Route::put('/edit-storage/{id}', [ProductHasXController::class,'update_productstore']);

Route::get('/delete-storage/{id}', [ProductHasXController::class,'delete_productstore']);
Route::delete('/delete-storage/{id}', [ProductHasXController::class,'destroy_productstore']);
