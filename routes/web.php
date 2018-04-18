<?php

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Auth::routes();

Route::get('/posts', 'PostController@index')->name('list_posts');

Route::group(['prefix' => 'posts'], function () {
    Route::get('/drafts', 'PostController@drafts')
        ->name('list_drafts')
        ->middleware('auth');

    Route::get('/show/{slug}', 'PostController@show')
        ->name('show_post');
        
    Route::get('/create', 'PostController@create')
        ->name('create_post')
        ->middleware('can:create-post');
    Route::post('/create', 'PostController@store')
        ->name('store_post')
        ->middleware('can:create-post');

    Route::get('/edit/{post}', 'PostController@edit')
        ->name('edit_post')
        ->middleware('can:update-post,post');
    Route::post('/edit/{post}', 'PostController@update')
        ->name('update_post')
        ->middleware('can:update-post,post');

    Route::post('/delete/{post}', 'PostController@destory')
        ->name('delete_post')
        ->middleware('can:delete-post,post');
        
    Route::get('/publish/{post}', 'PostController@publish')
        ->name('publish_post')
        ->middleware('can:publish-post,post');
    Route::get('/unpublish/{post}', 'PostController@unpublish')
        ->name('unpublish_post')
        ->middleware('can:publish-post,post');
});
