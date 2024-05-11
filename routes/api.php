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
use App\Http\Controllers\Api\FavoriteController;
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
Route::get('mediaIndex', [MediaShowController::class, 'indexNew']);
Route::get('media/search' , [MediaShowController::class, 'search']);
// Mostrar una media show:
Route::get('/media/{id}', [MediaShowController::class, 'show']);
// Eliminar una media show en concreto en el panel de administrador:
Route::delete('/media/{id}', [MediaShowController::class, 'destroy']);
// Crear una nueva media show:
Route::post('media/', [MediaShowController::class, 'store']);

// Route::get('/media/genre/{id}', [MediaShowController::class, 'viewByGenreID']);

// Agregar una valoracion a una media show:
Route::post('media/valoration', [MediaShowController::class, 'addValorations']);

// Verificar si la media show ya ha sido valorada por el usuario actual
Route::get('/valorations/{id}', [MediaShowController::class, 'checkIfValuated']);

// Obtenemos las valoraciones de una media show en concreto:
Route::get('/media/valorations/{id}', [MediaShowController::class, 'getMediaShowValorations']);

// Agregar una media show a favoritos:
Route::post('/favorites/{id}', [MediaShowController::class, 'manageToFavorites']);

// Verificar si la media show ya está en favoritos para mostrar una imagen de favoritos u otra:
Route::get('/favorites/{id}', [FavoriteController::class, 'getCheckFavorites']);

// Obtenemos los media shows favoritos de un user en concreto:
Route::get('user/favorites', [MediaShowController::class, 'getMediaShowFavorites']);

// Obtenemos los media shows visualizadas de un user en concreto:
// Route::get('user/visualizated/{id}', [MediaShowController::class, 'getMediaShowVisualizated']);
Route::get('user/visualizated', [MediaShowController::class, 'getMediaShowVisualizated']);


// Agregar una media show a visualizadas:
Route::post('/visualizated/{id}', [MediaShowController::class, 'manageToVisualizated']);

// Verificar si la media show ya está en visualizadas para mostrar una imagen de visualizada u otra:
Route::get('/visualizated/{id}', [MediaShowController::class, 'checkIfVisualizated']);

// Obtener los mediashow segun el género
Route::get('genres/media', [GenreController::class, 'getMediaShowByGenre']);

// Obtener los mediashow segun el tipo (Serie o película)
Route::get('media_show_type/media', [MediaShowController::class, 'getMediaShowByMediaShowType']);

// Modificar los datos del usuario:
Route::put('/users/{user}', [UserController::class, 'update']);

Route::post('/agregar-media', [MediaController::class, 'store'])->name('media.store');
Route::get('countries', [CountryController::class, 'view']);
Route::get('pemis', [PemiController::class, 'view']);
Route::get('/pemis', [PemiController::class, 'view']);
Route::get('genres', [GenreController::class, 'view']);
Route::get('mediaShowType', [TypeMediaShowController::class, 'view']);

Route::group(['middleware' => 'auth:sanctum'], function() {
    // Eliminar el usuario:
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

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