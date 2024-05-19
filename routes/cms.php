<?php

use App\Http\Controllers\DiseaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\DiseaseCategoryController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\TopicController;
<<<<<<< HEAD
use App\Models\Product;
=======
use App\Http\Controllers\ProductController;
>>>>>>> 6888dd5a03a0b14585c0d8428a5298532ca0561b

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
Route::group(['prefix' => 'disease-category','as' => 'disease-category.'],function(){
    Route::get('/',[DiseaseCategoryController::class,'getList'])->name('getList');
    Route::get('/{diseaseCategoryId}',[DiseaseCategoryController::class,'getDetail'])->name('getDetail');
    Route::post('/create',[DiseaseCategoryController::class,'create'])->name('create');
    Route::post('/{diseaseCategoryId}/update',[DiseaseCategoryController::class,'update'])->name('update');
    Route::delete('/{diseaseCategoryId}/delete',[DiseaseCategoryController::class,'delete'])->name('delete');
});

Route::group(['prefix' => 'topic','as' => 'topic.'],function(){
    Route::get('/',[TopicController::class,'getList'])->name('getList');
    Route::get('/{topicId}',[TopicController::class,'getDetail'])->name('getDetail');
    Route::post('/create',[TopicController::class,'create'])->name('create');
    Route::post('/{topicId}/update',[TopicController::class,'update'])->name('update');
    Route::delete('/{topicId}/delete',[TopicController::class,'delete'])->name('delete');
});

Route::group(['prefix' => 'tag','as' => 'tag.'],function(){
    Route::get('/',[TagController::class,'getList'])->name('getList');
    Route::get('/{topicId}',[TagController::class,'getDetail'])->name('getDetail');
    Route::post('/create',[TagController::class,'create'])->name('create');
    Route::post('/{topicId}/update',[TagController::class,'update'])->name('update');
    Route::delete('/{topicId}/delete',[TagController::class,'delete'])->name('delete');
});

<<<<<<< HEAD
Route::group(['prefix' => 'product-category','as' => 'product-category.'],function(){
    Route::get('/',[ProductCategoryController::class,'getList'])->name('getList');
    Route::get('/{productCategoryId}',[ProductCategoryController::class,'getDetail'])->name('getDetail');
    Route::post('/create',[ProductCategoryController::class,'create'])->name('create');
    Route::post('/{productCategoryId}/update',[ProductCategoryController::class,'update'])->name('update');
    Route::delete('/{productCategoryId}/delete',[ProductCategoryController::class,'delete'])->name('delete');
    Route::post('/{productCategoryId}/slug',[ProductCategoryController::class,'enableDisable'])->name('enableDisable');
=======
Route::group(['prefix' => 'product','as' => 'product.'],function(){
    Route::get('/',[ProductController::class,'getList'])->name('getList');
    Route::get('/{productId}',[ProductController::class,'getDetail'])->name('getDetail');
    Route::post('/create',[ProductController::class,'create'])->name('create');
    Route::post('/{productId}/update',[ProductController::class,'update'])->name('update');
    Route::delete('/{productId}/delete',[ProductController::class,'delete'])->name('delete');
>>>>>>> 6888dd5a03a0b14585c0d8428a5298532ca0561b
});