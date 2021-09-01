<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\VerificationController;
// use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| API Routes
|
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


	



Route::post('/login', [AuthController::class , 'login']);
Route::post('/register',[AuthController::class , 'register']);
Route::get('/logout', [AuthController::class , 'logout']);
Route::group(['middleware' => ['jwt.verify']] , function(){
    Route::get('/logout', [AuthController::class , 'logout']);

    Route::group(['prefix' =>'products'] , function(){
        Route::get('/show' , [ProductController::class , 'show']);

    });
    Route::group(['prefix' =>'user'] , function(){
        Route::get('/show/{id}' ,[UsersController::class , 'show']);
        Route::put('/update/{id}' , [UsersController::class , 'update']);
        Route::delete('/delete/{id}' , [UsersController::class , 'destroy']);
    });



    Route::group(['prefix' =>'cart'] , function(){
        Route::get('/create' , [CartController::class , 'createCart']);
        Route::get('/show/{id}' ,[CartController::class , 'getCart']);
        Route::post('/store' , [CartController::class , 'addToCart']);
        Route::delete('/delete' , [CartController::class , 'removeItem']);
        Route::delete('/clear/{id}' , [CartController::class , 'clearCart']);
    });
    Route::post('/checkout/order', 'API\CheckoutController@placeOrder')->name('checkout.place.order');

    Route::group(['prefix' =>'reviews'] , function(){
        Route::get('/' ,[ReviewController::class , 'index']);
        Route::get('/show/{id}' ,[ReviewController::class , 'show']);
        Route::post('/store' , [ReviewController::class , 'store']);
        Route::put('/update/{id}' , [ReviewController::class , 'update']);
        Route::delete('/delete/{id}' , [ReviewController::class , 'destroy']);
    });
});














		


			
			
			
				
			
	
		

		




		
		
	


   


