<?php

use App\Http\Controllers\Admin\PartnerController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

if (App::environment('production')) {
    URL::forceScheme('https');
}

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

Route::get('/', [\App\Http\Controllers\PmcController::class, 'welcome']);

Route::prefix('internal-admin')->group(function() {
    Route::get('/', function() {
        return view('internal_admin_app');
    });
    Route::get('{any}', function ($any) {
        return view('internal_admin_app');
    })->where('any', '.*')->name('internal-admin');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified', 'admin.type:admin']], function () {
    Route::get('/', function() {
        return redirect()->route('admin.partners');
    });
    Route::get('/dashboard', function () {
        return redirect()->route('admin.partners');
    })->name('dashboard');

    // PARTNER ROUTES
    Route::get('/partners', [PartnerController::class, 'index'])->name('admin.partners');
    Route::get('/partners/create', [PartnerController::class, 'create'])->name('admin.partners.create');
    Route::post('/partners/store', [PartnerController::class, 'store'])->name('admin.partners.store');
    Route::get('/partners/import-csv', [PartnerController::class, 'importCSV'])->name('admin.partners.import-csv');
    Route::post('/partners/import-csv', [PartnerController::class, 'storeCSV'])->name('admin.partners.store-csv');
    Route::get('/partners/edit/{id}', [PartnerController::class, 'edit'])->name('admin.partners.edit');
    Route::put('/partners/update/{id}', [PartnerController::class, 'update'])->name('admin.partners.update');

    Route::get('/partners/filter/{keyword?}', [PartnerController::class, 'filter'])->name('admin.partners.filter');

    // Route::get('/import-partners',)
});

Route::prefix('pmc')->group(function() {

    Route::post('test_email', [\App\Http\Controllers\PmcController::class, 'testEmail']);

    Route::get('email/{hash?}', [\App\Http\Controllers\PmcController::class, 'emailForm'])->name('pmc.email');
    Route::post('email', [\App\Http\Controllers\PmcController::class, 'emailSubmit'])->name('pmc.email.submit');

    Route::get('recover/{hash}', [\App\Http\Controllers\PmcController::class, 'longHashRecover']);

    Route::get('contact/{hash?}', [\App\Http\Controllers\PmcController::class, 'contactForm'])->name('pmc.contact');
    Route::post('contact', [\App\Http\Controllers\PmcController::class, 'contactSubmit'])->name('pmc.contact.submit');

    Route::get('assets/{hash?}', [\App\Http\Controllers\PmcController::class, 'assetsForm'])->name('pmc.assets');
    Route::post('assets', [\App\Http\Controllers\PmcController::class, 'assetsSubmit'])->name('pmc.assets.submit');

    Route::get('payment/{hash?}', [\App\Http\Controllers\PmcController::class, 'paymentForm'])->name('pmc.payment');
    Route::post('payment', [\App\Http\Controllers\PmcController::class, 'paymentSubmit'])->name('pmc.payment.submit');

    Route::get('calendar/{hash?}', [\App\Http\Controllers\PmcController::class, 'calendarForm'])->name('pmc.calendar');
    Route::post('calendar', [\App\Http\Controllers\PmcController::class, 'calendarSubmit'])->name('pmc.calendar.submit');

    Route::get('thank_you/{hash?}', [\App\Http\Controllers\PmcController::class, 'thankYou'])->name('pmc.thank_you');
//    Route::post('thank_you', [\App\Http\Controllers\PmcController::class, 'calendarSubmit'])->name('pmc.calendar.submit');


    Route::post('payment_processed', [\App\Http\Controllers\PmcController::class, 'paymentProcessed']);

    Route::get('unsubscribe', [\App\Http\Controllers\PmcController::class, 'unsubscribe']);
    Route::get('asset/download/{hash}', [\App\Http\Controllers\PmcController::class, 'downloadAsset']);

    Route::post('pre_payment_check', [\App\Http\Controllers\PmcController::class, 'prePaymentCheck']);
    Route::post('check_token', [\App\Http\Controllers\PmcController::class, 'checkToken']);


    Route::get('api/layouts', [\App\Http\Controllers\AssetsController::class, 'layoutsJson']);


    Route::get('api/layouts/{code}/image/{imageCode}', [\App\Http\Controllers\AssetsController::class, 'layoutImageInfoJson']);

    Route::get('api/layouts/{code}/template/{templateCode}', [\App\Http\Controllers\AssetsController::class, 'layoutTemplateInfoJson']);

    Route::get('api/copies', [\App\Http\Controllers\AssetsController::class, 'fullCopiesJson']);
    Route::get('api/cib_copies', [\App\Http\Controllers\AssetsController::class, 'fullCibCopiesJson']);

    Route::get('api/extra_data/{hash}', [\App\Http\Controllers\AssetsController::class, 'extraData']);

    Route::post('api/image/upload', [\App\Http\Controllers\PmcController::class, 'uploadImage']);

    Route::get('test', [\App\Http\Controllers\AssetsController::class, 'test']);
    Route::get('test/{hash}', [\App\Http\Controllers\AssetsController::class, 'test2']);
    Route::get('test2', [\App\Http\Controllers\TestController::class, 'test']);
});

Route::prefix('instance')->group(function() {
    Route::post('frontend', [\App\Http\Controllers\InstancesController::class, 'FrontEndJson']);
});

Route::post('stripe/create', [\App\Http\Controllers\StripeController::class, 'CreatePayment']);



Route::get('/icon.p', [\App\Http\Controllers\InstancesController::class, 'Favicon']);
//Route::get('/icon.pn', [\App\Http\Controllers\InstancesController::class, 'Favicon']);
//Route::get('/icon.png', [\App\Http\Controllers\InstancesController::class, 'Favicon']);
//Route::get('/favicon.i', [\App\Http\Controllers\InstancesController::class, 'Favicon']);

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});

require __DIR__.'/auth.php';
