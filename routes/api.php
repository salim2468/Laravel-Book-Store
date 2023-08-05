<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BooksController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/register', [UserController::class,'register']);
Route::post('/login', [UserController::class,'login']);


Route::middleware('auth:api')->group(function () {

    Route::get('/user', [UserController::class,'getAllUser']);  
    Route::get('/user/{id}', [UserController::class,'getUser']);
    
    
    // Route::get('/authors/{author}',[AuthorsController::class,'show']);
    // Route::get('/authors',[AuthorsController::class,'index']);
    // in place of defining each route use apiResource

    Route::apiResource('/authors',AuthorsController::class);
    
    Route::get('/books/{keyword}',[BooksController::class,'searchBook']);
    Route::apiResource('/books',BooksController::class);


});


    // Route::get('/books/search/{keyword}',[BooksController::class,'searchBook']);
    // Route::apiResource('/books',BooksController::class);

