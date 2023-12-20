<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/test', [App\Http\Controllers\TestController::class, 'index'])->name('test');

require __DIR__.'/redirect-301.php';

require __DIR__.'/gone-410.php';

require __DIR__ . '/auth.php';

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/about-us', [App\Http\Controllers\AboutController::class, 'index'])->name('about');

Route::resource('services', App\Http\Controllers\ServiceController::class)->parameters([
    'services' => 'service:slug'
]);

Route::resource('tax-centers', App\Http\Controllers\TaxcenterController::class)->parameters([
    'tax-centers' => 'taxcenter:slug'
]);

Route::get('/our-resources', [App\Http\Controllers\ResourceController::class, 'index'])->name('resources');

// subscribe
Route::post('/subscribe', [App\Http\Controllers\SubscriberController::class, 'store'])->name('subscriber.store');

// Team
Route::resource('team', App\Http\Controllers\MemberController::class)->parameters([
    'team' => 'team_member:slug'
]);

// Authors
Route::resource('authors', App\Http\Controllers\AuthorController::class)->parameters([
    'authors' => 'author:slug'
]);

// Team
Route::get('/career', [App\Http\Controllers\CareerController::class, 'index'])->name('career');

// Consulting
Route::get('/consulting', [App\Http\Controllers\ConsultingController::class, 'index'])->name('consulting');
Route::post('/consulting/send', [App\Http\Controllers\ConsultingController::class, 'send'])->name('consulting.send');

// Contact
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');

// Blog
Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog');
Route::post('/blog/search', [App\Http\Controllers\BlogController::class, 'search'])->name('blog.search');
Route::get('/blog/{article:slug}', [App\Http\Controllers\BlogController::class, 'article'])->name('blog.article');


// Policies
Route::view('/terms', 'static.terms')->name('terms');
Route::view('/privacy', 'static.privacy')->name('privacy');


/*===========================================================================
========== Admin Routes =====================================================
===========================================================================*/

Route::group([ "prefix" => "admin", 'middleware' => "auth" , "as" => "admin." ] , function(){


    // Dashboard
    Route::get('/dashboard' , [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // User
    Route::get('users/perPage/{num}', [App\Http\Controllers\Admin\UserController::class, 'perPage'])->name("users.perPage");
    Route::post('users/search', [App\Http\Controllers\Admin\UserController::class, 'search'])->name("users.search");
    Route::post('users/multiAction', [App\Http\Controllers\Admin\UserController::class, 'multiAction'])->name("users.multiAction");
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->except('destroy');
    Route::get('users/destroy/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'] )->name("users.destroy");

    // Member
    Route::get('member/perPage/{num}', [App\Http\Controllers\Admin\MemberController::class, 'perPage'])->name("member.perPage");
    Route::post('member/search', [App\Http\Controllers\Admin\MemberController::class, 'search'])->name("member.search");
    Route::post('member/multiAction', [App\Http\Controllers\Admin\MemberController::class, 'multiAction'])->name("member.multiAction");
    Route::resource('member', App\Http\Controllers\Admin\MemberController::class)->parameters(['member' => 'member:slug'])->except('destroy');
    Route::get('member/destroy/{member:slug}', [App\Http\Controllers\Admin\MemberController::class, 'destroy'] )->name("member.destroy");

    // Role
    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);

    // profile
    Route::get('profile/edit' , [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name("profile.edit");
    Route::put('profile/update' , [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name("profile.update");


    // categories
    Route::get('category/perPage/{num}' , [App\Http\Controllers\Admin\CategoryController::class, 'perPage'])->name("category.perPage");
    Route::post('category/search' , [App\Http\Controllers\Admin\CategoryController::class, 'search'])->name("category.search");
    Route::post('category/multiAction' , [App\Http\Controllers\Admin\CategoryController::class, 'multiAction'])->name("category.multiAction");
    Route::resource('category', App\Http\Controllers\Admin\CategoryController::class)->except('destroy');
    Route::get('category/destroy/{id}' , [App\Http\Controllers\Admin\CategoryController::class, 'destroy'] )->name("category.destroy");

    //CKEditor Image Upload
    Route::post('/ckeditor/upload/{directoryName?}/{folderName?}', [\App\Http\Controllers\Admin\CKEditorUploadImageController::class, 'upload'])->name('ckeditor.upload');

    // articles
    Route::get('articles/perPage/{num}' , [App\Http\Controllers\Admin\ArticleController::class, 'perPage'])->name("articles.perPage");
    Route::post('articles/search' , [App\Http\Controllers\Admin\ArticleController::class, 'search'])->name("articles.search");
    Route::post('articles/multiAction' , [App\Http\Controllers\Admin\ArticleController::class, 'multiAction'])->name("articles.multiAction");
    Route::get('articles/trash' , [App\Http\Controllers\Admin\ArticleController::class, 'getTrash'] )->name("articles.trash");
    Route::get('articles/delete/{article}' , [App\Http\Controllers\Admin\ArticleController::class, 'delete'] )->name("articles.delete");
    Route::get('articles/trash/restore/{id}' , [App\Http\Controllers\Admin\ArticleController::class, 'restore'] )->name("articles.restore");
    Route::get('articles/trash/force-delete/{id}' , [App\Http\Controllers\Admin\ArticleController::class, 'forceDelete'] )->name("articles.force.delete");
    Route::get('articles/{article:slug}/content' , [App\Http\Controllers\Admin\ArticleController::class, 'createContent'])->name("articles.content.create");
    Route::put('articles/{article:slug}/content' , [App\Http\Controllers\Admin\ArticleController::class, 'storeContent'])->name("articles.content.store");
    Route::resource('articles', App\Http\Controllers\Admin\ArticleController::class)->parameters([
        'articles' => 'article:slug'
    ])->except('destroy');



    // taxcenters
    Route::get('taxcenters/perPage/{num}' , [App\Http\Controllers\Admin\TaxCenterController::class, 'perPage'])->name("taxcenters.perPage");
    Route::post('taxcenters/search' , [App\Http\Controllers\Admin\TaxCenterController::class, 'search'])->name("taxcenters.search");
    Route::post('taxcenters/multiAction' , [App\Http\Controllers\Admin\TaxCenterController::class, 'multiAction'])->name("taxcenters.multiAction");
    Route::get('taxcenters/trash' , [App\Http\Controllers\Admin\TaxCenterController::class, 'getTrash'] )->name("taxcenters.trash");
    Route::get('taxcenters/delete/{taxcenter}' , [App\Http\Controllers\Admin\TaxCenterController::class, 'delete'] )->name("taxcenters.delete");
    Route::get('taxcenters/trash/restore/{id}' , [App\Http\Controllers\Admin\TaxCenterController::class, 'restore'] )->name("taxcenters.restore");
    Route::get('taxcenters/trash/force-delete/{id}' , [App\Http\Controllers\Admin\TaxCenterController::class, 'forceDelete'] )->name("taxcenters.force.delete");
    Route::get('taxcenters/{taxcenter:slug}/content' , [App\Http\Controllers\Admin\TaxCenterController::class, 'createContent'])->name("taxcenters.content.create");
    Route::put('taxcenters/{taxcenter:slug}/content' , [App\Http\Controllers\Admin\TaxCenterController::class, 'storeContent'])->name("taxcenters.content.store");
    Route::resource('taxcenters', App\Http\Controllers\Admin\TaxCenterController::class)->parameters([
        'taxcenters' => 'taxcenter:slug'
    ])->except('destroy');



    // services
    Route::get('services/perPage/{num}' , [App\Http\Controllers\Admin\ServiceController::class, 'perPage'])->name("services.perPage");
    Route::post('services/search' , [App\Http\Controllers\Admin\ServiceController::class, 'search'])->name("services.search");
    Route::post('services/multiAction' , [App\Http\Controllers\Admin\ServiceController::class, 'multiAction'])->name("services.multiAction");
    Route::get('services/trash' , [App\Http\Controllers\Admin\ServiceController::class, 'getTrash'] )->name("services.trash");
    Route::get('services/delete/{service}' , [App\Http\Controllers\Admin\ServiceController::class, 'delete'] )->name("services.delete");
    Route::get('services/trash/restore/{id}' , [App\Http\Controllers\Admin\ServiceController::class, 'restore'] )->name("services.restore");
    Route::get('services/trash/force-delete/{id}' , [App\Http\Controllers\Admin\ServiceController::class, 'forceDelete'] )->name("services.force.delete");
    Route::get('services/{service:slug}/content' , [App\Http\Controllers\Admin\ServiceController::class, 'createContent'])->name("services.content.create");
    Route::put('services/{service:slug}/content' , [App\Http\Controllers\Admin\ServiceController::class, 'storeContent'])->name("services.content.store");
    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class)->parameters([
        'services' => 'service:slug'
    ])->except('destroy');


    // resources
    Route::get('resource/perPage/{num}' , [App\Http\Controllers\Admin\ResourceController::class, 'perPage'])->name("resource.perPage");
    Route::post('resource/search' , [App\Http\Controllers\Admin\ResourceController::class, 'search'])->name("resource.search");
    Route::post('resource/multiAction' , [App\Http\Controllers\Admin\ResourceController::class, 'multiAction'])->name("resource.multiAction");
    Route::resource('resource', App\Http\Controllers\Admin\ResourceController::class)->except('destroy');
    Route::get('resource/destroy/{resource}' , [App\Http\Controllers\Admin\ResourceController::class, 'destroy'] )->name("resource.destroy");


    // testimonial
    Route::get('testimonial/perPage/{num}' , [App\Http\Controllers\Admin\TestimonialController::class, 'perPage'])->name("testimonial.perPage");
    Route::post('testimonial/search' , [App\Http\Controllers\Admin\TestimonialController::class, 'search'])->name("testimonial.search");
    Route::post('testimonial/multiAction' , [App\Http\Controllers\Admin\TestimonialController::class, 'multiAction'])->name("testimonial.multiAction");
    Route::resource('testimonial', App\Http\Controllers\Admin\TestimonialController::class)->except('destroy');
    Route::get('testimonial/destroy/{testimonial}' , [App\Http\Controllers\Admin\TestimonialController::class, 'destroy'] )->name("testimonial.destroy");


    // setting
    Route::get('setting/edit' , [App\Http\Controllers\Admin\SettingController::class, 'edit'])->name("setting.edit");
    Route::put('setting/update' , [App\Http\Controllers\Admin\SettingController::class, 'update'])->name("setting.update");




    // subscriber
    Route::get('subscriber/perPage/{num}' , [App\Http\Controllers\Admin\SubscriberController::class, 'perPage'])->name("subscriber.perPage");
    Route::post('subscriber/search' , [App\Http\Controllers\Admin\SubscriberController::class, 'search'])->name("subscriber.search");
    Route::post('subscriber/multiAction' , [App\Http\Controllers\Admin\SubscriberController::class, 'multiAction'])->name("subscriber.multiAction");
    Route::resource('subscriber', App\Http\Controllers\Admin\SubscriberController::class)->except('destroy');
    Route::get('subscriber/destroy/{id}' , [App\Http\Controllers\Admin\SubscriberController::class, 'destroy'] )->name("subscriber.destroy");



    // newsletter
    Route::get('newsletter/perPage/{num}' , [App\Http\Controllers\Admin\NewsletterController::class, 'perPage'])->name("newsletter.perPage");
    Route::post('newsletter/search' , [App\Http\Controllers\Admin\NewsletterController::class, 'search'])->name("newsletter.search");
    Route::post('newsletter/multiAction' , [App\Http\Controllers\Admin\NewsletterController::class, 'multiAction'])->name("newsletter.multiAction");
    Route::resource('newsletter', App\Http\Controllers\Admin\NewsletterController::class)->except('destroy');
    Route::get('newsletter/destroy/{id}' , [App\Http\Controllers\Admin\NewsletterController::class, 'destroy'] )->name("newsletter.destroy");

    Route::resource('pages',\App\Http\Controllers\Admin\PageController::class);


});
