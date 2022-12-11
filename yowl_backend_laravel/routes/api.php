<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MailController;
use App\Mail\MailtrapExample;
use Illuminate\Support\Facades\Mail;

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

Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return $request->user();
});


/*-- Users --*/
Route::get("/users", [UserController::class, "GetUsers"]);
Route::get("/users/{id}", [UserController::class, "GetUser"]);
Route::get("/users/{id}/admin/status", [UserController::class, "GetAdminStatus"]);
Route::get("/users/{id}/age", [UserController::class, "getUserAge"]);
Route::get("/usersWithUsername/{username}", [UserController::class, "getUserWithUsername"]);
Route::post("/AddUser", [UserController::class, "TestCreate"]);
Route::post("/AddUserTest", [UserController::class, "Register"]);
Route::post("/Login", [UserController::class, "Login"]);
Route::put("/User/{id}/Modify", [UserController::class, "UpdateUser"]);
Route::put("/users/{id}/ValidateAccount", [UserController::class, "validateAccount"]);
Route::put("/users/{id}/updateFromUser", [UserController::class, "updateUserByUser"]);
Route::delete("/DeleteUser/{id}", [UserController::class, "TestDelete"]);

/*-- Posts --*/
Route::get("/posts", [PostController::class, "GetPosts"]);
Route::get("/posts/{id}", [PostController::class, "GetPost"]);
Route::get("/posts/filteredByAuthor/{id}", [PostController::class, "GetPostsFromUser"]);
Route::get("/posts/filteredByCategory/{id}", [PostController::class, "FilterByCategory"]);
Route::get("/posts/search/{search}", [PostController::class, "GetSearchedPosts"]);
Route::get("/GetPostsAuthors", [PostController::class, "GetPostAuthors"]);
Route::get("/GetPostAuthor/{id}", [PostController::class, "GetPostAuthor"]);
Route::get("/GetPostCategories", [PostController::class, "GetPostCategories"]);
Route::get("/PostsPerCategory/{categoryId}", [PostController::class, "GetPostCountPerCategory"]);
Route::get("/FilterByCategoryTitle/{title}", [PostController::class, "AltFilterByCategory"]);
Route::get("/getTop3PostAuthorId", [PostController::class, "getTop3PostAuthorId"]);
Route::post("/AddPost", [PostController::class, 'TestCreate']);
Route::post("/CreatePost", [PostController::class, 'CreatePost']);
Route::delete("/posts/delete/{id}", [PostController::class, "deletePost"]);
Route::delete("/posts/deletePerCategory/{categoryId}", [PostController::class, "deletePostsPerCategory"]);

/*-- Categories --*/
Route::get("/categories", [CategoryController::class, 'GetCategories']);
Route::get("/categories/{id}", [CategoryController::class, 'GetCategory']);
Route::get("/categoryFromTitle/{input}", [CategoryController::class, "GetCategoryFromInput"]);
Route::post("/AddCategory", [CategoryController::class, "CreateCategory"]);
Route::put("/categories/modify/{id}", [CategoryController::class, "UpdateCategory"]);
Route::delete("categories/delete/{id}", [CategoryController::class, "deleteCategory"]);

/*-- Comments --*/
Route::get("/comments", [CommentController::class, 'GetComments']);
Route::get("/comments/{id}", [CommentController::class, 'GetComment']);
Route::get("/posts/{id}/comments/", [CommentController::class, "GetCommentByPost"]);
Route::get("/posts/{id}/comments/count", [CommentController::class, "CommentsCountPerPosts"]);
Route::get("/GetTopComments", [CommentController::class, "GetTopCommentedPosts"]);
Route::post("/post/{post_id}/addComment/{userId}", [CommentController::class, "AddCommentToPostByUser"]);
Route::put("/comments/{commentId}/update/{userId}", [CommentController::class, "UpdateCommentByUser"]);
Route::delete("comments/{id}/deleteAdmin", [CommentController::class, "DeleteCommentById"]);
Route::delete("comments/{postId}/{userId}/{commentId}", [CommentController::class, "DeleteCommentByPostByUserById"]);
Route::delete("comments/deletePerPost/{postId}", [CommentController::class, "DeleteAllCommentsPerPost"]);
Route::delete("comments/deletePerUser/{userId}", [CommentController::class, "DeleteAllCommentsPerUser"]);

/*-- Verify email --*/
Route::get("/validateAccount/{id}", [UserController::class, "validateAccount"]);
