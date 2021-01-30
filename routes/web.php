<?php

use App\Http\Controllers\CalcController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController as IC;
use App\Http\Controllers\SimulateController as SCR;
use App\Http\Controllers\OilWellOwnersController as OWOC;
use App\Http\Controllers\MemberArea\AuthEmailController as AEmail;
use App\Http\Controllers\MemberArea\HomeController as HC;
use App\Http\Controllers\MemberArea\ContractsController as CC;
use App\Http\Controllers\MemberArea\ProfileController as PC;
use App\Http\Controllers\MemberArea\SettingsController as SC;
use App\Http\Controllers\MemberArea\CustomerMessagesController as CMC;
use App\Http\Controllers\MemberArea\ReferralsController as RC;
use App\Http\Controllers\MemberArea\TransactionCallBackController as TCBC;
use App\Http\Controllers\ContactUsController as CUC;
use App\Http\Controllers\MemberArea\SocialImpactController as SIC;
use App\Http\Controllers\MemberArea\Wallet\WalletController as WC;
use App\Http\Controllers\MemberArea\Wallet\TransactionController as TC;
use App\Http\Controllers\MemberArea\Wallet\WithdrawalController as WDC;

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
// Email Verification
Route::prefix('email')->group(function () {
    // Email verification
    Route::get('/verify/{id}/{hash}', [AEmail::class, "verify"])->middleware(['auth', 'signed'])->name('verification.verify');
    // Email verification resend email
    Route::get('/verification-notification', [AEmail::class, "resend"])->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

    //puzzle verification
    Route::get('/puzzle/verification', [AEmail::class, "getPuzzle"])->name('puzzle-verification-view');
    Route::get('/email/verification', [AEmail::class, "puzzleEmailVerification"])->name('puzzle-email-verification');
});

//simulated
Route::get('simulated-user/{hash}', [SCR::class, "simulateUser"])->name('simulate-user');

//index
Route::prefix('/')->group(function () {
    Route::get('/', [IC::class, "index"])->name('/');
    Route::get('/landing', [IC::class, "landing"])->name('landing');
    Route::get('/about-us', [IC::class, "aboutUs"])->name('about-us');
    Route::get('/login', [IC::class, "login"])->middleware(['guest'])->name('login');
    Route::get('/register', [IC::class, "register"])->middleware(['guest'])->name('register');
    Route::get('/calc', [CalcController::class, "index"])->name('calc');
    // Standard Pages
    Route::get('/privacy-policy', [IC::class, "privacyPolicy"])->name('privacy-policy');
    Route::get('/terms-and-conditions', [IC::class, "termsAndConditions"])->name('terms-and-conditions');
    Route::get('/data-security-policy', [IC::class, "dataSecurityPolicy"])->name('data-security-policy');
    Route::get('/gdpr-disclosure', [IC::class, "gdprDisclosure"])->name('gdpr-disclosure');
    Route::get('/risk-disclosure', [IC::class, "riskDisclosure"])->name('risk-disclosure');
    Route::get('/kyc-policy', [IC::class, "kycPolicy"])->name('kyc-policy');
    Route::get('/aml-policy', [IC::class, "amlPolicy"])->name('aml-policy');
});
// Customer Management
Route::prefix('customer')->group(function () {
    Route::get('/email', [IC::class, "email"])->name('customer.email');
    Route::get('/username', [IC::class, "userName"])->name('customer.username');
    Route::get('/get-name', [IC::class, "getName"])->name('customer.name');
});
// OilWellOwners Management
Route::prefix('oil-well-owners')->group(function () {
    Route::get('/', [OWOC::class, "index"])->name('oilWell.owners');
    Route::post('/store', [OWOC::class, "store"])->name('oilWell.owners.store');
});
// Contacts Management
Route::prefix('contact-us')->group(function () {
    Route::get('/', [CUC::class, "index"])->name('contact');
    Route::post('/store', [CUC::class, "store"])->name('contact.store');
});


// Member Area
Route::prefix('dashboard')->group(function () {
    Route::get('/', [HC::class, "index"])->name('dashboard');
    Route::get('/wallet-transaction', [HC::class, "walletData"])->name('dashboard.wallet');
    Route::get('/sopx-production', [HC::class, "sopxData"])->name('dashboard.production');
    Route::get('/contract-transaction', [HC::class, "contractProduction"])->name('dashboard.contract');
    Route::get('/knowledge-base', [HC::class, "knowledgeBase"])->name('knowledge-base');
    //! don't chnage anything here [Lathindu]
    // Route::get('/fixtherewards', [HC::class, "fixTheRewards"])->name('fixRewards');
    // Route::get('/fixthetr', [HC::class, "fixthetr"])->name('fixthetr');
    Route::get('/testtr', [HC::class, "testTr"])->name('testTr');
});

// Wallet Management
Route::prefix('wallet')->group(function () {
    // Wallet main route
    Route::get('/', [WC::class, "index"])->name('wallet.all');
    Route::get('/wallet-data', [WC::class, "walletData"])->name('wallet.data');
    // Wallet purchase route
    Route::get('/purchase', [WC::class, "purchaseAll"])->name('wallet.purchase');
    Route::get('/{id}/purchase', [WC::class, "purchaseView"])->name('wallet.purchase.view');
    // Wallet transaction route
    Route::prefix('transaction')->group(function () {
        Route::get('/create', [TC::class, "create"])->name('wallet.transactions.create');
        Route::get('/create/conversionRates', [TC::class, "conversionRates"])->name('wallet.transactions.conversionRates');
        Route::get('/create/conversionRates/real', [TC::class, "conversionRatesReal"])->name('wallet.transactions.conversionRates.real');

        Route::get('/get/btc', [TC::class, "getBtcTransaction"])->name('wallet.transactions.get.btc');
        Route::post('/store', [TC::class, "store"])->name('wallet.transactions.store');
        Route::post('/store/invoice', [TC::class, "storeInvoice"])->name('wallet.transactions.store.invoice');
        Route::post('/store/callback/eth', [TC::class, "storeCallbackEth"])->name('wallet.transactions.store.callback.eth');
        // From External
        Route::post('/store/callback/btc/validate', [TC::class, "BTCTransactionCallBackValidate"])->name('wallet.transactions.btc.callback.validate');
        Route::post('/store/callback/capp/validate', [TC::class, "cAPPTransactionCallBackValidate"])->name('wallet.transactions.capp.callback.validate');
        Route::post('/store/callback/zelle/validate', [TC::class, "zelleTransactionCallBackValidate"])->name('wallet.transactions.zelle.callback.validate');
        Route::any('/store/callback/btc', [TCBC::class, "storeTransactionCallbackBTC"])->name('wallet.transactions.store.callback.btc');
    });
    // Wallet withdraw route
    Route::prefix('withdrawals')->group(function () {
        Route::get('/', [WDC::class, "index"])->name('wallet.withdrawals.index');
        Route::get('/transaction', [WDC::class, "create"])->name('wallet.withdrawals.create');
        Route::get('/settings', [WDC::class, "settings"])->name('wallet.withdrawals.settings');
        Route::post('/transaction/store', [WDC::class, "store"])->name('wallet.withdrawals.store');
        Route::post('/settings', [WDC::class, "settingsStore"])->name('wallet.withdrawals.settings.store');
    });
});

// staking Management
Route::prefix('staking')->group(function () {
    Route::get('/', [CC::class, "index"])->name('contracts.all');
    Route::get('/create', [CC::class, "create"])->name('contracts.create');
    Route::post('/store', [CC::class, "store"])->name('contracts.store');
    Route::get('/{id}/view', [CC::class, "view"])->name('contracts.view');
    Route::get('/portfolio', [CC::class, "portfolio"])->name('contracts.portfolio');
    Route::get('/production', [CC::class, "production"])->name('contracts.production');
    Route::get('/calculator', [CC::class, "calculator"])->name('contracts.calculator');
    Route::post('/get/contracts', [CC::class, "getContracts"])->name('contracts.get');

    // Wallet Product route
    Route::get('/productions', [WC::class, "production"])->name('wallet.production');
});

// Profile Management
Route::prefix('profile')->group(function () {
    Route::get('/', [PC::class, "index"])->name('profile');
    Route::get('/get-states', [PC::class, "getStates"])->name('get-states');
    Route::post('/update', [PC::class, "update"])->name('profile.update');
    Route::post('/update/username', [PC::class, "updateUsername"])->name('profile.update.username');
    Route::get('/checkpassword', [PC::class, "checkPassword"])->name('profile.check.password');
});

// Settings Management
Route::prefix('settings')->group(function () {
    Route::get('/', [SC::class, "index"])->name('settings');
});

// Messages Management
Route::prefix('messages')->group(function () {
    Route::get('/', [CMC::class, "index"])->name('messages');
    Route::get('/view', [CMC::class, "view"])->name('messages.view');
    Route::post('/store', [CMC::class, "store"])->name('messages.store');
    Route::get('/read', [CMC::class, "read"])->name('messages.read');
    Route::get('/delete', [CMC::class, "delete"])->name('messages.delete');
    Route::get('/pusher', [CMC::class, "pusher"])->name('messages.pusher');
    Route::get('/notification', [CMC::class, "notification"])->name('messages.notification');
});

//Referrals Management
Route::prefix('referral-management')->group(function () {
    Route::get('/', [RC::class, "index"])->name('referrals');
    Route::get('/set-first', [RC::class, "setFirst"])->name('referrals.set.first');
    Route::post('/check-next', [RC::class, "checkNext"])->name('referrals.check.next');
    Route::post('/set-next', [RC::class, "setNext"])->name('referrals.set.next');
    Route::post('/modal', [RC::class, "loadModal"])->name('referrals.load.modal');
    Route::get('/child-modal', [RC::class, "childLoadModal"])->name('referrals.load.modal.child');
    Route::get('/settings', [RC::class, "settings"])->name('referrals.settings');
    Route::post('/settings/store', [RC::class, "settingsStore"])->name('referrals.settings.store');

    Route::get('/redemptions', [RC::class, "redemptions"])->name('referral.redemptions.create');
    Route::post('/redemptions', [RC::class, "redemptionsStore"])->name('referral.redemptions.store');

    Route::get('/transactions', [RC::class, "transactions"])->name('referrals.transactions');

    Route::get('/logs', [RC::class, "logs"])->name('referrals.logs');
});

//Social Impact Management
Route::prefix('social-impact')->group(function () {
    Route::get('/', [SIC::class, "index"])->name('social.impact');
    Route::get('/view/{degree?}', [SIC::class, "view"])->name('social.view');
    Route::get('/redemption/new', [SIC::class, "createRedemption"])->name('social.redemptions.create');
    Route::post('/redemption/post', [SIC::class, "storeRedemption"])->name('social.redemptions.store');
    Route::post('/collect/rewards/all', [SIC::class, "collectAllRewards"])->name('social.collect.rewards.all');
    Route::post('/collect/rewards/', [SIC::class, "collectRewards"])->name('social.collect.rewards');

    Route::get('/transactions', [SIC::class, "transactions"])->name('social.transactions');
});
