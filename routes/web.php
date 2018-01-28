<?php


use App\Events\OrderStatusUpdated;
use App\Events\OrderStatusChanged;

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
class Order{
    public $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
}
Route::get('/fire', function () {
    //event(new OrderStatusChanged);
    OrderStatusChanged::dispatch();
    OrderStatusUpdated::dispatch(new Order(5));
    return 'fired';
});
Route::get('/', function () {
    //event(new OrderStatusUpdated::class);
    return view('welcome');
});

auth()->loginUsingId(1);

Route::get('/update', function () {
    OrderStatusUpdated::dispatch(new Order(5));
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// User Routes
Route::middleware('auth')->group(function () {
    Route::get('/orders', 'UserOrdersController@index')->name('user.orders.index');
    Route::get('/orders/create', 'UserOrdersController@create')->name('user.orders.create');
    Route::post('/orders', 'UserOrdersController@store')->name('user.orders.store');
    Route::get('/orders/{order}', 'UserOrdersController@show')->name('user.orders.show');
});

// Admin Routes - Make sure you implement an auth layer here
Route::prefix('admin')->group(function () {
    Route::get('/orders', 'AdminOrdersController@index')->name('admin.orders');
    Route::get('/orders/edit/{order}', 'AdminOrdersController@edit')->name('admin.orders.edit');
    Route::patch('/orders/{order}', 'AdminOrdersController@update')->name('admin.orders.update');
});

Route::redirect('/admin', '/admin/orders');