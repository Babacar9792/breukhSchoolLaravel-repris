<?php

use App\Http\Controllers\AnneeScolaireController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\NiveauController;
use App\Models\AnneeScolaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// Pour les annees scolaires
Route::apiResource("/anneescolaire", AnneeScolaireController::class)->only(['index', "store", "update"]);


Route::put("/annee/{id}", [AnneeScolaireController::class, "archive"]);


// Pour les niveaux

Route::apiResource("/niveau", NiveauController::class)->only(['index', "store", "update"]);



Route::put("/niveaux/{id}", [NiveauController::class, "archive"]);


// Pour classes

Route::apiResource("/classe", ClasseController::class)->only(['index', "store", "update"]);


Route::put("/classes/{id}", [ClasseController::class, "archive"]);


Route::apiResource("/eleves", EleveController::class)->only(["store", "index", "update"]);



Route::post('/login',[UserController::class,'loginUser']);


Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::get('user',[UserController::class,'userDetails']);
    Route::get('logout',[UserController::class,'logout']);
});
