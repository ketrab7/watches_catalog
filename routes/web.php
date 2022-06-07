<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\PaginationController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(ModelController::class)->group(function () {
    Route::get('/', 'index');
    //dodawanie modelu
    Route::post('/create-model', 'createModel');
    //wyświetlenie edycji modelu
    Route::get('/edit-model/{id}', 'editModel')
        ->whereNumber('id');
    //aktualizacja modelu
    Route::post('/update-model', 'updateModel');
    //usuwanie modelu i zdjęcia
    Route::match(['get', 'delete'], '/delete-model/{id}', 'deleteModel')
        ->whereNumber('id');
});

Route::controller(ProductController::class)->group(function () {
    //wyświetlanie listy produktów
    Route::get('/{model_id}/products-list', 'productsList')
        ->whereNumber('model_id');
    //wyświetlanie karty produktowej
    Route::get('/{model_id}/product-card/{product_id}', 'productCard')
        ->whereNumber('model_id')
        ->whereNumber('product_id');
    //wyszukiwanie produktu
    Route::get('/search-product', 'searchProduct');
    //wyświetlanie dodania nowego produktu
    Route::get('/{model_id}/create-product', 'createProduct')
        ->whereNumber('model_id');
    //dodanie nowego produktu
    Route::match(['get', 'post'],'/{model_id}/store-product', 'storeProduct')
        ->whereNumber('model_id');
    //wyświetlenie edycji produktu
    Route::get('/{model_id}/edit-product/{product_id}', 'editProduct')
        ->whereNumber('model_id')
        ->whereNumber('product_id');
    //aktualizacja danych o produkcie / dodanie nowych zdjęć
    Route::match(['get', 'post'],'/{model_id}/update-product', 'updateProduct')
        ->whereNumber('model_id');
    //usuwanie wybranych zdjęć z produktu
    Route::delete('/{model_id}/delete-product-images', 'deleteImages')
        ->whereNumber('model_id');
     //usuwanie produktu i zdjęć
    Route::match(['get', 'delete'], '/{model_id}/delete-product/{product_id}', 'deleteProduct')
        ->whereNumber('model_id')
        ->whereNumber('product_id');
});

Route::controller(PaginationController::class)->group(function () {
    //usuwanie paginacji
    Route::get('/destroy-paginate', 'destroyPagination');
    //zmiana paginacji
    Route::post('/update-paginate', 'updatePagination');
});
//instrukcja
Route::get('/info', function () {
    return view('system.help');
});