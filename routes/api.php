<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('')

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('micronutrients/vitamins',[\App\Http\Controllers\MicronutrientController::class,'vitamins']);
Route::get('micronutrients/minerals',[\App\Http\Controllers\MicronutrientController::class,'minerals']);

Route::get('micronutrients/{micronutrient}/efficiencies/{efficiency}',[\App\Http\Controllers\MicronutrientController::class,'microByEfficiency']);
Route::get('micronutrients/{micronutrient}/usages/{usage}',[\App\Http\Controllers\MicronutrientController::class,'microByUsage']);
Route::get('micronutrients/{micronutrient}/powers/{power}',[\App\Http\Controllers\MicronutrientController::class,'microByPower']);
Route::get('micronutrients/{micronutrient}/side-effects',[\App\Http\Controllers\MicronutrientController::class,'microBySideEffect']);
Route::get('references/micronutrients/{micronutrient}/',[\App\Http\Controllers\ReferenceController::class,'referenceByMicro']);
Route::get('references/{code}/micronutrients/{id}/',[\App\Http\Controllers\ReferenceController::class,'referenceByCodeAndMicro']);


Route::apiResources([
    'diseases' => \App\Http\Controllers\DiseaseController::class,
    'drugs' => \App\Http\Controllers\DrugController::class,
    'side-effects' => \App\Http\Controllers\SideEffectController::class,
    'health-statuses' => \App\Http\Controllers\HealthStatusController::class,
    'efficiencies' => \App\Http\Controllers\EfficiencyController::class,
    'powers' => \App\Http\Controllers\PowerController::class,
    'usages' => \App\Http\Controllers\UsageController::class,
    'micronutrients' => \App\Http\Controllers\MicronutrientController::class,
    'references' => \App\Http\Controllers\ReferenceController::class,

    'drug-micronutrient' => \App\Http\Controllers\DrugMicroController::class,
    'disease-micronutrient' => \App\Http\Controllers\DiseaseMicroController::class,
    'health-status-micronutrient' => \App\Http\Controllers\HealthStatusMicroControlller::class,
    'side-effect-micronutrient' => \App\Http\Controllers\SideEffectMicroControlller::class
]);

