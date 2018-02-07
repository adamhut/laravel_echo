<?php


use App\Task;
use App\Events\OrderStatusChanged;
use App\Events\OrderStatusUpdated;
use App\Events\TaskCreated;

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
class Order
{
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


Route::get('/tasks',function(){
    return Task::latest()->pluck('body');
});

Route::post('/tasks', function () {
    $task = Task::forceCreate(request(['body']));
    //TaskCreated::dispatch($task);
    event((new TaskCreated($task))->dontBroadcastToCurrentUser());
});

//auth()->loginUsingId('31c80361-6534-4dd3-b530-a6df0b0c4650');

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
