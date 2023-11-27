<?php
use App\Http\Controllers\API\V1\Products\ProductController;
use App\Http\Controllers\API\V1\Users\UsersController;
use App\Http\Controllers\API\V1\Users\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(ProductController::class)
    ->name("store.")
    ->prefix("/v1/products")
    //->middleware(['auth:api', ''])
    ->group(function () {
        //fetch
        Route::get('/fetch-products', "getProducts")->name("fetch_products");
    });


//fetch users
Route::controller(UsersController::class)
    ->name("users.")
    ->middleware(['auth:sanctum']) // Add the auth:sanctum middleware
    ->prefix("/v1/users")
    ->group(
        function () {
            Route::get('/fetch-users', 'getAllUsers');
        }
);

//register users
Route::controller(UsersController::class)
    ->name("users.")
    ->prefix("/v1/users")
    ->group(

        function () {
            Route::post('/register', 'register');
        }
);

// Authenticate users
Route::name("users.")
    ->prefix("/v1/users")
    ->group(function () {
        Route::post('/login', [AuthController::class, 'login'])->name('api.login');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });
