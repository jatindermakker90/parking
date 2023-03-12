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
use App\Http\Controllers\Admin\OfferTypeController;
use App\Http\Controllers\Admin\AddDiscountController;
use App\Http\Controllers\Admin\FlatDiscountController;
use App\Http\Controllers\Admin\AssignDiscountController;


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
        Route::get('change/booking/status/{table_id}',         [BookingsController::class, 'changeBookingsStatus'])->name('change_booking_status');

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
        Route::resource('settings',                                     SettingController::class);     
        Route::get('pages/list',                                         [SettingController::class, 'index']); 
        //============================= End ===================================//

        // ========================== discount =====================================//
        Route::prefix('discount')->group(function () {
            Route::resource('offer-type',                           OfferTypeController::class);
            Route::get('offer-type-create',                         [OfferTypeController::class, 'create']);
            Route::get('change/offerType/status/{table_id}',        [OfferTypeController::class, 'changeOfferTypeStatus'])->name('change_offer_type_status');


            Route::resource('add-discount',                           AddDiscountController::class);
            Route::get('discoun-code-list',                           [AddDiscountController::class, 'discountCodeList'])->name('discoun-code-list');
            Route::get('discoun-code-report',                           [AddDiscountController::class, 'discountCodeReport'])->name('discoun-code-report');

            Route::resource('flat-discount',                           FlatDiscountController::class);

            Route::resource('assign-discount',                           AssignDiscountController::class);

        });
       //======================================================================//
    });
    
});