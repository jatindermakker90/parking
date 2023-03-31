<?php

use Illuminate\Support\Facades\Route;

/* ==============  Admin =============== */
use App\Http\Controllers\Admin\Auth\LoginController           as AdminLoginController;
use App\Http\Controllers\Admin\Auth\RegisterController        as AdminRegisterController;
use App\Http\Controllers\Admin\Auth\VerificationController    as AdminVerificationController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController   as AdminResetPasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController  as AdminForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ConfirmPasswordController as AdminConfirmPasswordController;

use App\Http\Controllers\Admin\HomeController  as AdminHomeController;
use App\Http\Controllers\Admin\AirportTerminalController;
use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\BookingsController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\AirportController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\OfferTypeController;
use App\Http\Controllers\Admin\AddDiscountController;
use App\Http\Controllers\Admin\FlatDiscountController;
use App\Http\Controllers\Admin\AssignDiscountController;
use App\Http\Controllers\Admin\AffiliateDiscountController;
use App\Http\Controllers\Admin\ReviewController;

use App\Http\Controllers\HomeController;

/* ==============  Admin =============== */
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

Route::get('/', function () {
    return view('frontend.index');
});
//==  Default views =========//
Route::middleware('auth')->group(function () {
     Route::post('/upload-image',  [HomeController::class, 'uploadImage'])->name('upload-image');
});
//=== End Views ====//
//    Admin Views //
Route::prefix('admin')->group(function () {

    Route::get('/login',  [AdminLoginController::class, 'login'])->name('get_admin_login');
    Route::get('/import',  [AdminLoginController::class, 'import'])->name('get_import');
    Route::post('/login',  [AdminLoginController::class, 'postLogin'])->name('post_admin_login');
    Route::middleware('auth')->group(function () {
       Route::get('/', [AdminHomeController::class, 'home'])->name('admin_home');
       Route::any('/logout', [AdminLoginController::class, 'logout'])->name('post_admin_logout');
       Route::get('dashboard/stats', [AdminHomeController::class, 'adminDashboardStats'])->name('admin_dashbaord_stats');
       Route::get('dashboard/rides', [AdminHomeController::class, 'adminDashboardRides'])->name('admin_dashbaord_rides');
       Route::get('dashboard/commission', [AdminHomeController::class, 'adminDashboardCommissons'])->name('admin_dashbaord_commissions');

       // ========================= Roles ====================================//
       Route::get('/user/roles',  [AdminHomeController::class, 'userRoles'])->name('user_roles');
       Route::get('change/user/roles/status/{table_id}',  [AdminHomeController::class, 'changeUserRolesStatus'])->name('change_user_roles_status');

       //======================================================================//
        Route::resource('service-providers',                    AdminController::class);
        Route::get('change/admin/status/{table_id}',           [AdminController::class, 'changeAdminStatus'])->name('change_admin_status');

        Route::resource('products',                            ProductsController::class);
        Route::get('change/product/status/{table_id}',         [ProductsController::class, 'changeProductsStatus'])->name('change_product_status');

        Route::get('fetch/product/details',                    [ProductsController::class, 'getProductDetails'])->name('get_product_details');

        Route::resource('bookings',                            BookingsController::class);

        Route::get('add/booking',                              [BookingsController::class, 'create']);
        Route::post('store/booking',                            [BookingsController::class, 'store'])->name('booking-store');
        Route::post('update/booking',                            [BookingsController::class, 'update'])->name('booking-update');
        Route::get('cancelled/booking',                        [BookingsController::class, 'cancelledBookingList'])->name('cancelled_booking');
        Route::get('trasheded/booking',                        [BookingsController::class, 'trashededBookingList'])->name('trasheded_booking');

        Route::get('change/booking/status/{table_id}',          [BookingsController::class, 'changeBookingsStatus'])->name('change_booking_status');
        Route::post('booking/search-booking-companies',         [BookingsController::class, 'searchCompanyList'])->name('search-booking-companies');
        Route::get('booking/search-booking-companies',          [BookingsController::class, 'searchCompanyListGet'])->name('search-booking-companies-get');
        Route::get('booking/get-single-booking',                [BookingsController::class, 'getSingleBooking'])->name('get-single-booking');
        Route::get('booking/get-change-status-html',            [BookingsController::class, 'getChangeStatusHtml'])->name('get-change-status-html');
        Route::post('booking/change-booking-status',            [BookingsController::class, 'getChangeBookingStatus'])->name('change-booking-status');

        Route::resource('invoices',                            InvoiceController::class);
        Route::get('change/invoice/status/{table_id}',           [InvoiceController::class, 'changeInvoiceStatus'])->name('change_invoice_status');

       // ========================== User =====================================//
        Route::get('/user/all',                                 [UserController::class, 'index'])->name('user_list');
        Route::resource('users',                                UserController::class);
        Route::get('change/users/status/{table_id}',            [UserController::class, 'changeUsersStatus'])->name('change_users_status');
       //======================================================================//
       // ========================== company =====================================//
        Route::resource('companies',                            CompanyController::class);
        Route::post('company-store',                            [CompanyController::class, 'store'])->name('company-store');
        Route::get('fetch/terminal/details',                    [CompanyController::class, 'fetchTerminalDetails'])->name('fetch_terminal_details');
        Route::get('company/owners',                            [CompanyController::class, 'companyOwnersView'])->name('company-owners');
        Route::get('change/company/status/{table_id}',          [CompanyController::class, 'changeCompanyStatus'])->name('change_company_status');
        Route::post('company/assign-user-to-companies',         [CompanyController::class, 'assignUserToCompanies'])->name('assign-user-to-companies');
        Route::post('company/remove-user-to-companies',         [CompanyController::class, 'removeUserToCompanies'])->name('remove-user-to-companies');
        Route::get('company/company-operation-html/{id}',       [CompanyController::class, 'companyOperationHtml'])->name('company-operation-html');
        // close company routes
        Route::get('company/close-company',                     [CompanyController::class, 'closeCompany'])->name('close-company');
        Route::post('company/close-company-store',              [CompanyController::class, 'closeCompanyStore'])->name('close-company-store');
        Route::get('company/get-edit-close-company-html',       [CompanyController::class, 'getcloseCompanyEditHtml'])->name('get-edit-close-company-html');
        Route::post('company/close-company-update',             [CompanyController::class, 'closeCompanyUpdate'])->name('close-company-update');
        Route::delete('company/close-company-delete/{id}',            [CompanyController::class, 'closeCompanyDelete'])->name('close-company-delete');
       //======================================================================//
       //============================ Country ===============================//
        Route::resource('countries',                            CountriesController::class)/*->middleware(['allow_admin'])*/;
        Route::get('change/countries/status/{table_id}',        [CountriesController::class, 'changeCountriesStatus'])->name('change_countries_status');
        Route::get('fetch/countries/details',                   [CountriesController::class, 'getCountriesDetails'])->name('get_countries_details');
        //============================= End ===================================//
        //============================ airport ===============================//
        Route::resource('airport',                              AirportController::class)/*->middleware(['allow_admin'])*/;
        Route::get('change/airport/status/{table_id}',         [AirportController::class, 'changeAirportStatus'])->name('change_airport_status');
        //============================= End ===================================//
        //============================ terminals ===============================//
        Route::resource('terminals',                                    AirportTerminalController::class)/*->middleware(['allow_admin'])*/;
        Route::get('change/airport/terminal/status/{table_id}',         [AirportTerminalController::class, 'changeAirportTerminalStatus'])->name('change_airport_terminal_status');
        //============================= End ===================================//

        //============================ settings ===============================//
        Route::resource('site/settings',                                     SettingController::class);
        Route::get('pages/list',                                         [SettingController::class, 'getpagelist'])->name('get_page_list');
        Route::get('email/template',                                         [SettingController::class, 'getemailtemplatepage'])->name('get_email_template');
        Route::get('payment/settings',                                         [SettingController::class, 'getpaymentsettingpage'])->name('get_payment_setting_page');
        Route::get('sms/settings',                                         [SettingController::class, 'getsmssettingpage'])->name('get_sms_setting_page');
        //============================= End ===================================//

        // ========================== Review =====================================//
        Route::prefix('review')->group(function () {
            Route::resource('list',                           ReviewController::class);
            Route::get('checklist',                       [ReviewController::class,'reviewchecklistpage'])->name('review_checklist');
            Route::get('insert/{ref}',                          [ReviewController::class,'reviewinsertpage'])->name('review_insert');
        });
        // ========================== discount =====================================//
        Route::prefix('discount')->group(function () {
            Route::resource('offer-type',                           OfferTypeController::class);
            Route::get('offer-type-create',                         [OfferTypeController::class, 'create']);
            Route::get('change/offerType/status/{table_id}',        [OfferTypeController::class, 'changeOfferTypeStatus'])->name('change_offer_type_status');

            Route::resource('affiliate-discount',                    AffiliateDiscountController::class);

            Route::resource('add-discount',                           AddDiscountController::class);
            Route::get('discount-code-list',                          [AddDiscountController::class, 'discountCodeList'])->name('discount-code-list');
            Route::get('discount-code-report',                        [AddDiscountController::class, 'discountCodeReport'])->name('discount-code-report');
            Route::get('discount-code-code-report',                   [AddDiscountController::class, 'discountCodeCodeReport'])->name('discount-code-code-report');

            Route::resource('flat-discount',                           FlatDiscountController::class);

            Route::resource('assign-discount',                           AssignDiscountController::class);

        });
       //======================================================================//
    });
    Route::post('/compare-two-date',  [BookingsController::class, 'checkIfEndDateIsGreater'])->name('compare-two-date');
    Route::post('/validate-coupon-code',  [AddDiscountController::class, 'validateCouponCode'])->name('validate-coupon-code');

});
