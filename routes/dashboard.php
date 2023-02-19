<?php


use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductsController;
use Illuminate\Support\Facades\Route;


/*
 * Route::group([
    'middleware' => ['auth'],
    'prefix'     => 'dashboard',
    'as'         => 'dashboard.',
   // 'namespace' => 'App\Http\Controllers\Dashboard',
],function (){
    // Route::get('/','DashboardController@index')
     ->only('edit','show')
     ->except('index','create');
    Route::resource('/', DashboardController::class);
    Route::resource('/categories', CategoriesController::class);
});
*/

Route::middleware(['auth'])
    ->as('dashboard.')
    ->prefix('dashboard')
    ->group(function (){
        Route::get('/', function (){
            return view('dashboard.index');
        })->name('index');

        Route::get('/categories/trashed', [CategoriesController::class,'trashed'])->name('categories.trashed');
        Route::put('/categories/{category}/restore', [CategoriesController::class,'restore'])->name('categories.restore');
        Route::delete('/categories/{category}/force-delete', [CategoriesController::class,'forceDelete'])->name('categories.forceDelete');
        Route::resource('/categories', CategoriesController::class);

        Route::get('/products/trashed', [ProductsController::class,'trashed'])->name('products.trashed');
        Route::put('/products/{product}/restore', [ProductsController::class,'restore'])->name('products.restore');
        Route::delete('/products/{product}/force-delete', [ProductsController::class,'forceDelete'])->name('products.forceDelete');
        Route::resource('/products', ProductsController::class);

    });

