<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Web\IndexController;
// use App\Http\Controllers\Web\ConfigController; // file ada
// use App\Http\Controllers\Web\AboutUsController;
// use App\Http\Controllers\Web\PagesController; // file ada
// use App\Http\Controllers\Web\CustomPageController; // file ada
// use App\Http\Controllers\Web\PrivacyAndPolicyController; //file ada
// use App\Http\Controllers\Web\TermsAndConditionsController; //file ada
// use App\Http\Controllers\Web\ContactController;
// use App\Http\Controllers\Web\FaqController;
// use App\Http\Controllers\Web\BlogController;
// use App\Http\Controllers\Web\BlogCategoryController;
// use App\Http\Controllers\Web\BlogDetailController;
// use App\Http\Controllers\Web\CartController;
// use App\Http\Controllers\Web\CheckoutController;
// use App\Http\Controllers\Web\WishlistController;
// use App\Http\Controllers\Web\OrderController;
// use App\Http\Controllers\Web\ProductController; // file ada
// use App\Http\Controllers\Web\ProductDetailController;
// use App\Http\Controllers\Web\ProductReviewController;
// use App\Http\Controllers\Web\StoreController; // file ada
// use App\Http\Controllers\Web\StoreCategoryController;
// use App\Http\Controllers\Web\StoreDetailController;
// use App\Http\Controllers\Web\StoreReviewController;
// use App\Http\Controllers\Web\ChatController;
// use App\Http\Controllers\Web\PaymentController;
// use App\Http\Controllers\Web\RefundController;
// use App\Http\Controllers\Web\SearchController;


Route::get('/maintenance', function () {
    return inertia('Maintenance');
})->name('maintenance');

// Grup rute untuk tamu.
Route::middleware(['check.maintenance'])->group(function () {

    Route::get('/', [IndexController::class, 'index'])->name('home');

});
