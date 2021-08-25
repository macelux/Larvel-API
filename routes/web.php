<?php

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WEB\Authcontroller;
use App\Http\Controllers\WEB\ProductController; 
use App\Http\Controllers\WEB\UsersController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\WEB\OrderController;
use App\Http\Controllers\WEB\ReviewController;
use App\Http\Controllers\WEB\AdminController;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\WEB\NotificationsController;
use App\Http\Controllers\FileUpload;
use App\Http\Controllers\API\CartController;
use Illuminate\Support\Facades\Storage;
//use App\Http\Controllers\VerificationController;


//use App\Http\Controllers\PhotoController;


// use Auth;

// use Illuminate\Http\RedirectResponse;





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
Route::get('cart/show/{id}' ,[CartController::class , 'getCart']);
Route::get('/file' , function (){
//     Storage::disk('local')->download('example.txt');
//    Storage::disk('local')->move('example.txt' , 'text/example.txt');
    return Storage::allfiles('/');
//    Storage::temporaryUrl('example.txt' , now()->addMinutes(5));
//    if (Storage::disk('local')->missing('example.txt'))
//        return Storage::get('example.txt');
//    if(Storage::disk('local')->missing('cool'))
//        return "missing";
//    $disk = Storage::build([
//
//    ]);
//    $path = Storage::disk('local')->put('example.txt' , 'cool');
//    return $path;
});
Route::get('/modal' , fn() =>view('modals/create'));
Route::get('/clear/{id}' , [CartController::class , 'clearCart']);
Route::resource('photos' , PhotoController::class );
//Route::get('/link' , function (){
//    return asset(storage/app/storage/profile pic.jpg);
//});
Route::get('/upload-file', [FileUpload::class, 'createForm']);
Route::post('/upload-file', [FileUpload::class, 'fileUpload'])->name('fileUpload');


Route::get('/email/verify' , fn() => view('auth/verify'))->middleware('auth:admin')->name('verification.notice');

Route::get('/' , function () {

    if(Auth::guard('admin')->user())
    {

        if(!Auth::guard('admin')->user()->hasVerifiedEmail())
        {
            event(new Registered(Auth::guard('admin')->user()));
            return redirect() -> route('verification.notice');
        }
        else
        {
        }

            return redirect() -> route('admin.dashboard');
    }


    else
    {
        return redirect()-> route('login');
    }
})->name('home');




Route::get('/reset', fn() => view('auth/passwords/reset'))->name('password/reset');
		
Route::get('/register', fn() => view('auth/register'))->name('register');
Route::post('/register', [Authcontroller::class,'register'])->name('register');
		
Route::get('/login', fn() => view('auth/login'))->name('login');
Route::post('/login', [Authcontroller::class,'login'])->name('login');


Route::post('/logout', [Authcontroller::class,'logout'])->name('logout');


//
 Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {

     $request->fulfill();
//     return $request->id;
//     return auth()->user();

//     if(auth()->user())
//     {
//         return response(["message" => "email verfied succesfully"]);
//     }
//     else
        return redirect()->route('home');
 })->middleware(['auth:admin', 'signed'])->name('verification.verify');
// Route::get('/email/verify/{id}/{hash}', [V])->middleware(['auth:admin', 'signed'])->name('verification.verify');


    Route::post('/email/verification-notification', function (Request $request) {
    	$request->user()->sendEmailVerificationNotification();
    	return back()->with('message' , 'Verification link sent!');

    })->name('verification.send')->middleware(['auth:admin', 'throttle:6,1']);

Route::group(['prefix' =>'admin'] , function(){


	Route::group(['middleware' => ['auth:admin' , 'verified']] , function() {
        Route::group(['prefix' => 'profile'] , function() {
            Route::get('/' , [AdminController::class , 'editprofile'])->name('profile.show');
            Route::put('/update' , [AdminController::class , 'update'])->name('profile.update');
        });

        Route::get('/notifications/get' , [NotificationsController::class , 'getNotificationsData'])->name('notifications.get');
        Route::get('/dashboard', fn() =>  view('pages/dashboard'))->name('admin.dashboard');
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/users', [UsersController::class, 'index'])->name('users.index');
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
        Route::get('/roles', fn() => view('pages/roles'))->name('roles.show');
        Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
        Route::get('/create', [AdminController::class, 'create'])->name('admin.admin.create');
        Route::post('/store', [AdminController::class, 'store'])->name('admin.admin.store');
        Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admin.admin.edit');
        Route::post('/update', [AdminController::class, 'update'])->name('admin.admin.update');
        Route::get('/delete/{id}', [AdminController::class, 'destroy'])->name('admin.admin.delete');




		Route::group(['prefix' => 'products'], function () {
			Route::get('/create' , [ProductController::class , 'create'])->name('admin.products.create');
			Route::post('/store' , [ProductController::class , 'store'])->name('admin.products.store');
			Route::post('/update' , [ProductController::class , 'update'])->name('admin.products.update');
			Route::get('/edit/{id}', [ProductController::class , 'edit'])->name('admin.products.edit');
			Route::get('/delete/{id}' , [ProductController::class , 'destroy'])->name('admin.products.delete');
		});

        Route::group(['prefix' => 'users'], function () {
            Route::get('/edit/{id}', [UsersController::class , 'edit'])->name('admin.users.edit');
            Route::post('/update' , [UsersController::class , 'update'])->name('admin.users.update');
            Route::get('/delete/{id}' , [UsersController::class , 'destroy'])->name('admin.users.delete');
        });

        Route::group(['prefix' => 'orders'], function () {
            Route::get('/edit/{id}', [OrderController::class , 'edit'])->name('admin.orders.edit');
            Route::post('/update' , [OrderController::class , 'update'])->name('admin.orders.update');
            Route::get('/{order}/show', [OrderController::class , 'show'])->name('admin.orders.show');
            Route::get('/delete/{id}' , [OrderController::class , 'destroy'])->name('admin.orders.delete');
        });

	});
});
				


			

		
		
		




				

	


		
		




		



	


		
		
		
		

		
		
	
		
	
