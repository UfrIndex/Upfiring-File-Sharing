<?php

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

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Кэш очищен!";
});


Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@search')->name('search');
Route::post('/update-seeders/{id}', 'Site\UfrfileController@update_seeders_info')->name('upd_seeders');
Route::get('/file_update', 'Site\UfrfileController@file_update')->name('file_update');
Route::get('/update_file_update', 'Site\UfrfileController@update_file_update')->name('update_file_update');

Auth::routes(['verify' => true]);
Route::get('/contact', 'HomeController@sendMailForm')->name('contact');
Route::post('/send-mail', 'HomeController@sendMail')->name('send.mail');
Route::get('/cron_update', 'Site\UfrfileController@cron')->name('update_seeds');

//Route::resource('/upload-file', 'Site\UfrfileController');
Route::middleware(['auth', 'web'])->group(function () {
    Route::post('/{id}/report', 'ReportController@store')->name('report.store');
    Route::post('/{id}/comment', 'Admin\CommentController@store')->name('comment.store');
    Route::post('/{id}/like', 'Site\LikeController@set_like')->name('set_like');
    Route::post('/{id}/dislike', 'Site\LikeController@set_dislike')->name('set_dislike');
    Route::get('/upload-ufr', 'Site\UfrfileController@create')->name('upload-file.create');
    Route::post('/upload-ufr', 'Site\UfrfileController@store')->name('upload-file.store');
    Route::post('/upload-ufr/{id}/delete', 'Site\UfrfileController@delete_file')->name('upload-file.delete');
});

Route::get('/upload-ufr/{slug}', 'Site\UfrfileController@show')->name('upload-file.show');
Route::get('/download-file/{slug}', 'Site\UfrfileController@download_file')->name('download-file');
Route::get('/top-10-files', 'Site\UfrfileController@top_10_files')->name('top10files');
Route::get('/top-uploaders', 'Site\UfrfileController@top_10_users')->name('top-uploaders');
Route::get('/category/{category}', 'Admin\CategoryController@show')->name('category.show');
Route::get('/user/{id}', 'Site\UfrfileController@user_files')->name('userFiles');


Route::get('/contact-us', 'Site\SendmailController@contact')->name('send-mail');
Route::get('/dmca', 'Site\SendmailController@dmca')->name('send-dmca');

Route::get('/message-sent', 'Site\SendmailController@thank_you')->name('get-sender-mail');
Route::post('/message-sent', 'Site\SendmailController@send_contact_form')->name('sender-mail');

//Route::get('/search', 'Site\UfrfileController@search')->name('search');


Route::middleware(['auth', 'web', 'admin'])->prefix('admin')->group(function () {
    Route::get('/setting', 'SettingController@index')->name('admin.setting.index');
    Route::put('/setting', 'SettingController@update')->name('admin.setting.update');
    Route::get('/', 'HomeController@admin_index')->name('admin-home');
    Route::post('/files/multiselect', 'Admin\FilesController@multiselect',  ['as' => 'admin'])->name('admin.files.multiselect');
    Route::post('/pages/multiselect', 'Admin\PageController@multiselect',  ['as' => 'admin'])->name('admin.pages.multiselect');
    Route::post('/comments/multiselect', 'Admin\CommentController@multiselect',  ['as' => 'admin'])->name('admin.comments.multiselect');

    Route::get('/advertising_management', 'Admin\AdvertisingController@index', ['as' => 'admin'])->name('admin.advertising_management');
    Route::get('/site-options', 'Admin\OptionController@index', ['as' => 'admin'])->name('admin.site_options');
    Route::get('/for-approval', 'Admin\FilesController@forapproval', ['as' => 'admin'])->name('forapproval');
    Route::get('/approved', 'Admin\FilesController@approved', ['as' => 'admin'])->name('approved');
    Route::resource('/report', 'ReportController', ['as' => 'admin']);
    Route::resource('/pages', 'Admin\PageController', ['as' => 'admin']);
    Route::resource('/user', 'Admin\UserController',  ['as' => 'admin']);
    Route::resource('/comments', 'Admin\CommentController',  ['as' => 'admin']);
    Route::resource('/files', 'Admin\FilesController',  ['as' => 'admin']);
    Route::resource('/option', 'Admin\OptionController',  ['as' => 'admin']);
    Route::resource('/advertising', 'Admin\AdvertisingController',  ['as' => 'admin']);
    Route::post('/comments/change-status/{comment}', 'Admin\CommentController@change_status',  ['as' => 'admin'])->name('admin.comments.change-status');

});

Route::get('/{slug}', 'Site\PageController@index')->name('page');


//Route::get('/home', 'HomeController@index')->name('home');
