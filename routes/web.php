<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LangController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\frontend\ProductController;
use App\Http\Controllers\frontend\ProfilesController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('logout', [LoginController::class, 'logout']);


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product/show/{product}',[ProductController::class, 'show'])->name('product.detail');
Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');

Route::group(['middleware' => 'auth'], function () {
    //profile
    Route::get('/profile/{profile}',[ProfilesController::class,'index'])->name('profiles');
    Route::get('/profile/edit/{profile}',[ProfilesController::class,'edit'])->name('profiles.edit');
    Route::post('/profile/edit/{profile}',[ProfilesController::class,'update'])->name('profiles.update');


    //product
    Route::get('/product',[ProductController::class, 'index'])->name('product');
    Route::get('/product/edit/{product}',[ProductController::class,'edit'])->name('product.edit');
    Route::post('/product/edit/{product}',[ProductController::class,'update'])->name('product.update');
    Route::get('/product/create',[ProductController::class,'create'])->name('product.create');
    Route::post('/product/create',[ProductController::class,'store'])->name('product.store');
    Route::delete('/product/delete/{product}',[ProductController::class, 'delete'])->name('product.delete');

});

//admin
Route::prefix('admin')->group(function ()
 {
        Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('adminLogin');
        Route::post('/login', [AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
        Route::get('logout', [AdminAuthController::class, 'logout']);
        Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');


    Route::group(['middleware' => 'adminauth'], function ()
    {
        //admin index
        Route::get('/',[AdminController::class,'index'])->name('admin.index');

        // category
        Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
        Route::get('/categories/create',[CategoriesController::class, 'create'])->name('categories.create');
        Route::post('/categories/create',[CategoriesController::class, 'store'])->name('categories.store');
        Route::delete('/categories/delete/{category}',[CategoriesController::class, 'delete'])->name('categories.delete');
        Route::get('/categories/edit/{category}', [CategoriesController::class, 'edit'])->name('categories.edit');
        Route::post('/categories/edit/{category}',[CategoriesController::class, 'update'])->name('categories.update');

        //profile

        Route::get('/profile',[ProfileController::class,'index'])->name('profile.index');
        Route::get('/profile/edit/{profile}',[ProfileController::class,'edit'])->name('profile.edit');
        Route::post('/profile/edit/{profile}',[ProfileController::class,'update'])->name('profile.update');
        Route::delete('/profile/delete/{profile}',[ProfileController::class, 'delete'])->name('profile.delete');


        //products

        Route::get('/products',[ProductsController::class,'index'])->name('products.index');
        Route::get('/products/show/{product}',[ProductsController::class, 'show'])->name('products.show');
        Route::delete('/products/delete/{product}',[ProductsController::class, 'delete'])->name('products.delete');
        Route::get('/products/export',[ProductsController::class, 'export'])->name('products.export');
        Route::post('/products/import', [ProductsController::class, 'import'])->name('products.import');
    });


});
