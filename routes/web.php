<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoothController;
use App\Http\Controllers\BoothLayoutController;
use App\Http\Controllers\BoothOrderController;
use App\Http\Controllers\BoothTransactionController;
use App\Http\Controllers\CompanyContactController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromotionMessageController;
use App\Http\Controllers\RecapitulationController;
use App\Http\Controllers\RegistrationInputController;
use App\Http\Controllers\SettingController;
use App\Http\Middleware\Authenticated;
use App\Http\Middleware\RoleVerification;
use App\Models\BoothLayout;
use Illuminate\Support\Facades\Route;

// Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
// Route::get('/news', [HomeController::class, 'news'])->name('news');
// Route::get('/news/{slug}', [HomeController::class, 'detailNews'])->name('news.detail');
// Route::get('/agenda', [HomeController::class, 'agenda'])->name('agenda');
// Route::get('/agenda/{slug}', [HomeController::class, 'detailAgenda'])->name('agenda.detail');
// Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');

Route::get('/', function() {
   return redirect()->route('dashboard');
});
Route::middleware(['check-device'])->group(function () {
    Route::prefix('/auth')->controller(AuthController::class)->name('auth.')->group(function () {
        Route::get('/login', 'loginView')->name('login.view');
        Route::post('/login', 'loginProcess')->name('login.process');
        Route::get('/logout', 'logout')->name('logout');
    });

    Route::prefix('/admin')->middleware(Authenticated::class)->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::prefix('/profile')->name('profile.')->controller(ProfileController::class)->group(function () {
            Route::get('/{id?}', 'index')->name('index');
            Route::put('/', 'update')->name('update');
        });

        Route::middleware('role:administrator')->group(function () {
            Route::prefix('/account')->name('account.')->controller(AccountController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::delete('/{userId}', 'destroy')->name('destroy');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/{userId}', 'show')->name('show');
                Route::put('/{userId}', 'update')->name('update');
                Route::post('/generate', 'generate')->name('generate');
            });

            Route::prefix('/booth')->name('booth.')->controller(BoothController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'store')->name('store');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/get-description/{boothId}', 'getBoothDescription')->name('getBoothDescription');
                Route::get('/{boothId}', 'show')->name('show');
                Route::put('/{boothId}', 'update')->name('update');
                Route::delete('/{boothId}', 'destroy')->name('destroy');
            });

            Route::prefix('/layout')->name('layout.')->controller(LayoutController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'store')->name('store');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/{layoutId}', 'show')->name('show');
                Route::put('/{layoutId}', 'update')->name('update');
                Route::delete('/{layoutId}', 'destroy')->name('destroy');
                Route::prefix('/{layoutId}/booth')->name('booth.')->controller(BoothLayoutController::class)->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'store')->name('store');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::get('/booth-mapping', 'boothMapping')->name('boothMapping');
                    Route::get('/{boothLayoutId}', 'show')->name('show');
                    Route::put('/{boothLayoutId}', 'update')->name('update');
                    Route::delete('/{boothLayoutId}', 'destroy')->name('destroy');
                });
            });

            Route::prefix('/registration-input')->name('registrationInput.')->controller(RegistrationInputController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'store')->name('store');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/{inputId}', 'show')->name('show');
                Route::put('/{inputId}', 'update')->name('update');
                Route::delete('/{inputId}', 'destroy')->name('destroy');
            });
        });
        Route::middleware('role:humas')->group(function () {
            Route::prefix('/company-contact')->name('companyContact.')->controller(CompanyContactController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'store')->name('store');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/{contactId}', 'show')->name('show');
                Route::put('/{contactId}', 'update')->name('update');
                Route::delete('/{contactId}', 'destroy')->name('destroy');
            });
            Route::prefix('/agenda')->name('agenda.')->controller(AgendaController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'store')->name('store');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/{agendaId}', 'show')->name('show');
                Route::get('/{agendaId}/mapping', 'mapping')->name('mapping');
                Route::get('/{agendaId}/export-mapping', 'exportMapping')->name('exportMapping');
                Route::put('/{agendaId}', 'update')->name('update');
                Route::delete('/{agendaId}', 'destroy')->name('destroy');
            });
            Route::prefix('/content')->name('content.')->controller(ContentController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'store')->name('store');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/{contentId}', 'show')->name('show');
                Route::put('/{contentId}', 'update')->name('update');
                Route::delete('/{contentId}', 'destroy')->name('destroy');
            });
            Route::prefix('/promotion-message')->name('promotionMessage.')->controller(PromotionMessageController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'update')->name('update');
                Route::get('/send', 'sendView')->name('sendView');
                Route::post('/send', 'send')->name('send');
            });

            Route::prefix('/booth-transaction')->name('boothTransaction.')->controller(BoothTransactionController::class)->group(function () {
                Route::get('/{id}/edit-booth', 'editBooth')->name('editBooth');
                Route::put('/{id}/edit-booth', 'updateBooth')->name('updateBooth');
                Route::get('/{id}/edit-transaction-item', 'editTransactionItem')->name('editTransactionItem');
                Route::put('/{id}/edit-transaction-item', 'updateTransactionItem')->name('updateTransactionItem');
                Route::put('/{id}/verify-transaction', 'verifyTransaction')->name('verifyTransaction');
                Route::put('/{id}/verify-payment', 'verifyPayment')->name('verifyPayment');
                Route::put('/{id}/upload-faktur', 'uploadFakturFile')->name('uploadFakturFile');
            });
        });
        Route::middleware('role:perwakilan-perusahaan')->group(function () {
            Route::prefix('/booth-order')->name('boothOrder.')->controller(BoothOrderController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{agendaId}/booth-selection', 'boothSelection')->name('boothSelection');
                Route::post('/{agendaId}/booth-selection', 'boothSelectionStore')->name('boothSelectionStore');
                Route::post('/agenda', 'fetchAgenda')->name('fetchAgenda');
                Route::get('/{transactionId}/checkout', 'checkout')->name('checkout');
                Route::put('/{transactionId}/checkout', 'checkoutSave')->name('checkoutSave');
            });

            Route::prefix('/booth-transaction')->name('boothTransaction.')->controller(BoothTransactionController::class)->group(function () {
                Route::put('/{id}/upload-payment-proof', 'uploadPaymentProof')->name('uploadPaymentProof');
                Route::put('/{id}/upload-surat-permohonan', 'uploadSuratPermohonan')->name('uploadSuratPermohonan');
            });
        });

        Route::middleware('role:humas,administrator')->group(function () {
            Route::prefix('/setting')->name('setting.')->controller(SettingController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::put('/', 'update')->name('update');
            });
        });

        Route::middleware('role:humas,administrator,perwakilan-perusahaan')->group(function () {
            Route::prefix('/layout')->name('layout.')->controller(LayoutController::class)->group(function () {
                Route::prefix('/{layoutId}/booth')->name('booth.')->controller(BoothLayoutController::class)->group(function () {
                    Route::get('/booth-mapping', 'boothMapping')->name('boothMapping');
                    Route::get('/{boothLayoutId}/pov', 'getBoothPov')->name('getBoothPov');
                });
            });
        });

        Route::middleware('role:humas,perwakilan-perusahaan')->group(function () {
            Route::prefix('/booth-transaction')->name('boothTransaction.')->controller(BoothTransactionController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/{id}', 'show')->name('show');
                Route::get('/{id}/generate-invoice', 'generateInvoice')->name('generateInvoice');
            });

            Route::prefix('/recap')->name('recap.')->controller(RecapitulationController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{id}', 'show')->name('show');
                Route::put('/{id}', 'update')->name('update');
            });
        });
    });
});
