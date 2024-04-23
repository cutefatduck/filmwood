<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\MediaShowController;
use App\Http\Controllers\Api\TypeMediaShowController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\PemiController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('forget-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('forget.password.post');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.reset');
// Route::get('/peliculas', [PeliculasController::class, 'index'])->name('peliculas.index');
// Route::get('/series', [SeriesController::class, 'index'])->name('series.index');
Route::get('media', [MediaShowController::class, 'index']);
Route::post('media/', [MediaShowController::class, 'store']);
// Route::get('/media/genre/{id}', [MediaShowController::class, 'viewByGenreID']);

// Agregar una media show a favoritos:
Route::post('/favorites/{id}', [MediaShowController::class, 'manageToFavorites']);

// Agregar una media show a visualizadas:
Route::post('/visualizated/add/{id}', [MediaShowController::class, 'manageToVisualizated']);

// Obtener los mediashow segun el género
Route::get('genres/media', [GenreController::class, 'getMediaShowByGenre']);

// Obtener los mediashow segun el tipo (Serie o película)
Route::get('media_show_type/media', [MediaShowController::class, 'getMediaShowByMediaShowType']);

Route::delete('/media/{id}', [MediaShowController::class, 'destroy']);
#Route::get('/media/{id}', [MediaShowController::class, 'edit']);
Route::get('/media/{id}', [MediaShowController::class, 'show']);

Route::post('/agregar-media', [MediaController::class, 'store'])->name('media.store');
Route::get('countries', [CountryController::class, 'view']);
Route::get('pemis', [PemiController::class, 'view']);
Route::get('/pemis', [PemiController::class, 'view']);
Route::get('genres', [GenreController::class, 'view']);
Route::get('mediaShowType', [TypeMediaShowController::class, 'view']);

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::apiResource('users', UserController::class);
    Route::apiResource('posts', PostController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('roles', RoleController::class);
    //Route::apiResource('exercises', ExerciseController::class);
    Route::post('exercises/', [ExerciseController::class,'store']); //Guardar
    Route::get('exercises', [ExerciseController::class,'index']); //Listar
    Route::get('exercises/{exercise}', [ExerciseController::class,'show']); //Mostrar
    Route::post('exercises/update/{id}', [ExerciseController::class,'update']); //Editar

    Route::get('role-list', [RoleController::class, 'getList']);
    Route::get('role-permissions/{id}', [PermissionController::class, 'getRolePermissions']);
    Route::put('/role-permissions', [PermissionController::class, 'updateRolePermissions']);
    Route::apiResource('permissions', PermissionController::class);
    Route::get('category-list', [CategoryController::class, 'getList']);
    Route::get('/user', [ProfileController::class, 'user']);
    Route::put('/user', [ProfileController::class, 'update']);

    Route::get('abilities', function(Request $request) {
        return $request->user()->roles()->with('permissions')
            ->get()
            ->pluck('permissions')
            ->flatten()
            ->pluck('name')
            ->unique()
            ->values()
            ->toArray();
    });
});


Route::get('category-list', [CategoryController::class, 'getList']);
Route::get('get-posts', [PostController::class, 'getPosts']);
Route::get('get-category-posts/{id}', [PostController::class, 'getCategoryByPosts']);
Route::get('get-post/{id}', [PostController::class, 'getPost']);