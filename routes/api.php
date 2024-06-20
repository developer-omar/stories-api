<?php

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::post(
    "auth/login",
    [\App\Http\Controllers\Api\AuthenticationController::class, "login"]
)->name("auth.login");

Route::post(
    "users",
    [\App\Http\Controllers\Api\UserController::class, "store"]
)->name("user.store");

Route::get(
    "users/{id}",
    [\App\Http\Controllers\Api\UserController::class, "show"]
)   ->where('id', '[0-9]+')
    ->name("user.show");

Route::get(
    "categories",
    [\App\Http\Controllers\Api\CategoryController::class, "index"]
)->name("category.index");

Route::get(
    "genders",
    [\App\Http\Controllers\Api\GenderController::class, "index"]
)->name("gender.index");

Route::get(
    "audience-types",
    [\App\Http\Controllers\Api\AudienceTypeController::class, "index"]
)->name("audience-type.index");

Route::get(
    "copyright-types",
    [\App\Http\Controllers\Api\CopyrightTypeController::class, "index"]
)->name("copyright-type.index");

Route::prefix("stories")->group(function () {
    Route::get(
        "user/{userId}",
        [\App\Http\Controllers\Api\StoryController::class, "indexByUserId"]
    )   ->where('userId', '[0-9]+')
        ->name("story.index-by-user-id");

    Route::get(
        "category/{categoryId}",
        [\App\Http\Controllers\Api\StoryController::class, "indexByCategoryId"]
    )   ->where('categoryId', '[0-9]+')
        ->name("story.index-by-category-id");

    Route::get(
        "{id}",
        [\App\Http\Controllers\Api\StoryController::class, "show"]
    )   ->where('id', '[0-9]+')
        ->name("story.show");
});



/*-------------------------------------------------------------------------------------------------*/
//Routes that require jwt token

Route::middleware(['api', 'jwt.auth'])->group(function () {
    Route::get(
        "auth/logout",
        [\App\Http\Controllers\Api\AuthenticationController::class, "logout"]
    )->name("auth.logout");

    Route::prefix("users")->group(function () {
        Route::put(
            "change-email",
            [\App\Http\Controllers\Api\UserController::class, "changeEmail"]
        )->name("user.change-email");

        Route::put(
            "change-username",
            [\App\Http\Controllers\Api\UserController::class, "changeUsername"]
        )->name("user.change-username");

        Route::put(
            "change-password",
            [\App\Http\Controllers\Api\UserController::class, "changePassword"]
        )->name("user.change-password");

        Route::put(
            "update-profile",
            [\App\Http\Controllers\Api\UserController::class, "update"]
        )->name("user.update-profile");
    });

    Route::prefix("stories")->group(function () {
        Route::post(
            "",
            [\App\Http\Controllers\Api\StoryController::class, "store"]
        )->name("story.store");

        Route::put(
            "{id}",
            [\App\Http\Controllers\Api\StoryController::class, "update"]
        )   ->where('id', '[0-9]+')
            ->name("story.update");

        Route::delete(
            "{id}",
            [\App\Http\Controllers\Api\StoryController::class, "destroy"]
        )   ->where('id', '[0-9]+')
            ->name("story.destroy");
    });
});

Route::fallback(function (\App\Services\JsonResponseService $apiResponse) {
    return $apiResponse->http404();
});


