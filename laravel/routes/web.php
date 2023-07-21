<?php

use App\Http\Controllers\DeliverCont;
use App\Http\Controllers\FarmerCont;
use App\Http\Controllers\RetailCont;
use App\Http\Livewire\Inputaddress;
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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('farmer/register', [FarmerCont::class, 'showr']);
Route::post('fetch-subcounties', [Inputaddress::class, 'fetchSubcounties']);
Route::post('fetch-towns', [Inputaddress::class, 'fetchTowns']);
Route::post('farmer/authRegister', [FarmerCont::class, 'authRegister']);

Route::get('farmer/login', [FarmerCont::class, 'showl'])->name('flogin');
Route::post('farmer/auth', [FarmerCont::class, 'auth'])->name('flog-in');


Route::get('retailer/register', [RetailCont::class, 'showr']);
Route::post('retailer/authRegister', [RetailCont::class, 'authRegister']);

Route::get('retailer/login', [RetailCont::class, 'showl']);
Route::post('retailer/auth', [RetailCont::class, 'auth']);



Route::get('delivery-person/register', [DeliverCont::class, 'showr']);
Route::post('delivery-person/authRegister', [DeliverCont::class, 'authRegister']);

Route::get('delivery-person/login', [DeliverCont::class, 'showl']);
Route::post('delivery-person/auth', [DeliverCont::class, 'auth'])->name('dlog-in');

Route::middleware(['farmers'])->group(function () {
    // Routes for authenticated farmers
    // ...
    Route::get('farmer/dashboard', [FarmerCont::class, 'dashboard']);
    Route::get('farmer/fprofile', [FarmerCont::class, 'profile']);
    Route::post('farmer/livestock', [FarmerCont::class, 'livestock']);
    Route::get('farmer/{National_id}/requests', [FarmerCont::class, 'viewrequests']);
    Route::get('/farmer/{National_id}/viewgroups/', [FarmerCont::class, 'viewGroups']);
    Route::post('/farmer/viewgroups/join', [FarmerCont::class, 'joinGroup']);

    Route::get('farmergroup/dashboard', [FarmerCont::class, 'Fgdashboard']);
    Route::get('/farmergroup/view-requests', [FarmerCont::class, 'viewRrequests']);
    Route::post('/farmergroup/view-requests/accept/', [FarmerCont::class, 'confirm_Rrequest']);

    Route::get('/farmergroup/view-dp', [FarmerCont::class, 'viewDeliveryservices']);
    Route::post('/farmergroup/view-dp/request', [FarmerCont::class, 'deliveryrequest']);
    Route::get('/farmergroup/view-milkproduction', [FarmerCont::class, 'viewmilkproduction']);
    Route::post('farmergroup/confirmpickup', [FarmerCont::class, 'confirm_MC']);
    Route::get('/farmergroup/viewpayment', [FarmerCont::class, 'viewpayments']);
    Route::post('/farmergroup/farmer/confirmpayment', [FarmerCont::class, 'confirmpayment']);
});

Route::middleware(['retailers'])->group(function () {
    // Routes for authenticated retailers
    // ...
    Route::get('retailer/dashboard', [RetailCont::class, 'dashboard']);
    Route::get('retailer/{National_id}/rprofile', [RetailCont::class, 'profile']);
    Route::get('retailer/{National_id}/buymilk', [RetailCont::class, 'buymilk']);
    Route::post('retailer/buymilk/order', [RetailCont::class, 'order']);
    Route::get('retailer/viewdeliveries', [RetailCont::class, 'view_delivery']);
    Route::post('retailer/viewdeliveries/confirm', [RetailCont::class, 'confirm_delivery']);
    Route::get('retailer/viewtransactions', [RetailCont::class, 'viewpaymentsmade']);
    Route::post('/retailer/pay', [RetailCont::class, 'makePayment']);
});

Route::middleware(['dp'])->group(function () {
    // Routes for authenticated delivery persons
    // ...
    Route::get('delivery-person/dashboard', [DeliverCont::class, 'dashboard']);
    Route::get('delivery-person/profile', [DeliverCont::class, 'profile']);
    Route::get('delivery-person/requests', [DeliverCont::class, 'viewrequests']);
    Route::post('/delivery-person/view-requests/accept/', [DeliverCont::class, 'acceptrequest']);
    Route::get('delivery-person/pick-up', [DeliverCont::class, 'viewFMCP']);
    Route::post('delivery-person/pick-up/record', [DeliverCont::class, 'inputcollectiondata']);
    Route::get('delivery-person/deliver', [DeliverCont::class, 'viewdeliveryloc']);
    Route::post('delivery-person/recorddelivery', [DeliverCont::class, 'inputAD']);
    Route::get('/deliveryperson/viewpayments', [DeliverCont::class, 'viewpayments']);
    Route::post('/deliveryperson/confirmpayment', [DeliverCont::class, 'confirmpayment']);
});


require __DIR__ . '/auth.php';
