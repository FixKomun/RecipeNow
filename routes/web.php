<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecipeController;
use App\Http\Middleware\UserCheck;


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

//USER CONTROLLER
Route::prefix('app')->middleware([UserCheck::class])->group(function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/logout', [UserController::class, 'logout']);
});

//RECIPE CONTROLLER
Route::post('recipe/upload', [RecipeController::class, 'upload']);
Route::get('recipe/get-difficulty', [RecipeController::class, 'getDifficulty']);
Route::post('recipe/save-recipe', [RecipeController::class, 'saveRecipe']);
Route::get('recipe/get-recipes', [RecipeController::class, 'getRecipes']);
Route::get('recipe/delete-image', [RecipeController::class, 'deleteImage']);
Route::get('get-recipe/{id}', [RecipeController::class, 'getRecipe']);
Route::post('/edit-recipe', [RecipeController::class, 'editRecipe']);
Route::post('edit-recipe/upload', [RecipeController::class, 'upload']);
Route::get('get-user-recipes/{id}', [RecipeController::class, 'getUserRecipes']);



Route::get('/', [UserController::class, 'index']);

Route::any('{slug}', [UserController::class, 'index']);
