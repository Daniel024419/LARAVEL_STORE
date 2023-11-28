<?php
use App\Http\Controllers\API\V1\Products\ProductController;
use App\Http\Controllers\API\V1\Users\UsersController;
use App\Http\Controllers\API\V1\Users\AuthController;
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

            Route::get('/fetch-users', 'getAllUsers')->name("get_all_users");
            Route::get('/search-users/{search_param}', 'searchUsers')->name("search_users")->whereAlphaNumeric('search_param');

        }
);

//register users
Route::controller(UsersController::class)
    ->name("users.")
    ->prefix("/v1/users")
    ->group(

        function () {
            Route::post('/register', 'register')->name("register");
            Route::post('/update', 'updateUser')->middleware(['auth:sanctum'])->name("update_user");
        }
);

// Authenticate users
Route::controller(AuthController::class)
     ->name("users.")
    ->prefix("/v1/users")
    ->group(function () {
        Route::post('/login', 'login')->name('api.login');
        Route::get('/logout', 'logout')->middleware(['auth:sanctum'])->name('logout');
    });