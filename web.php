<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\ProfileController;


    //Blog Routes
    Route::controller(BlogController::class)->group(function(){
        Route::get('/admin/blog' , 'index')->name('blog.index');
        Route::get('/admin/blog/create' , 'create')->name('blog.create');
        Route::post('/admin/blog/store' , 'storeBlog')->name('blog.store');
        Route::get('/admin/blog/delete/{id}' , 'deleteBlog')->name('blog.delete');
        Route::get('/admin/blog/edit/{id}' , 'editBlog')->name('blog.edit');
        Route::put('/admin/blog/update/{id}' , 'updateBlog')->name('blog.update');
        Route::get('/admin/blog/status/{id}' , 'statusBlog')->name('blog.status');
    });
    
    //Category Routes
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/admin/category' , 'index')->name('category.index');
        Route::get('/admin/category/create' , 'create')->name('category.create');
        Route::post('/admin/category/store' , 'storeCategory')->name('category.store');
        Route::get('/admin/category/delete/{id}' , 'deleteCategory')->name('category.delete');
        Route::get('/admin/category/edit/{id}' , 'editCategory')->name('category.edit');
        Route::put('/admin/category/update/{id}' , 'updateCategory')->name('category.update');
    });

    //Tag Route
    Route::controller(TagController::class)->group(function(){
        Route::get('/admin/tag' , 'index')->name('tag.index');
        Route::get('/admin/tag/create' , 'create')->name('tag.create');
        Route::post('/admin/tag/store' , 'storeTag')->name('tag.store');
        Route::get('/admin/tag/delete/{id}' , 'deleteTag')->name('tag.delete');
        Route::get('/admin/tag/edit/{id}' , 'editTag')->name('tag.edit');
        Route::put('/admin/tag/update/{id}' , 'updateTag')->name('tag.update');
    });

    //UserProfile

    Route::controller(ProfileController::class)->group(function(){

        Route::get('/admin/profile' , 'profile')->name('user.profile');
        Route::get('/admin/account-setting' , 'accountSetting')->name('user.acount.setting');


    });


    // Route::get('/', function () {
//     return view('welcome');
// });
