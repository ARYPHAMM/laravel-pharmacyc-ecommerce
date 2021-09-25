<?php
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

use App\Http\Controllers\ui as uiRoute;
use App\Http\Controllers\admin as adminRouter;
use App\Http\Controllers\adminRouter\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category as categoryDB;
use App\Models\Product as productDB;
use App\Models\Post as postDB;



// Route::get('/', function () {
//   return view('welcome');
// })->name('home-default');
// Route::get('home', function () { // route no param
//     return 'Home';
// });
// Route::get('home/{ten}', function ($ten) { // route have param
//     return $ten;
// });
// Route::get('contact/{ten?}', function ($ten = 'xyz') { // route have param but params flow type value
//     return $ten;
// });
// Route::get('about/{ngay}', function ($ngay) { // route have param with conditon where regular exception
//     return $ngay;
// })->where(['ngay' => '[0-9]+']);
// // define a route with name
// #1
// Route::get('product1', [
//     'as' => 'product',
//     function () {
//         return 'Product page';
//     }
// ]);
// Route::get('product2',function(){
//    return redirect()->route('product');
// });
// #2
// Route::get('product3',function(){
// })->name('productThree');
// // // route group 
// // #1
// // Route::group(['prefix' => "news"],function (){
// //     Route::get('news1',function(){
// //         return "News 1";
// //      });
// //     Route::get('news2',function(){
// //         return "News 2";
// //      });
// //     Route::get('news3',function(){
// //         return "News 3";
// //      });
// // });
// // #2
// // Route::Prefix('page')->group(function (){
// //     Route::get('page1',function(){
// //         return "page 1";
// //      });
// //     Route::get('page2',function(){
// //         return "page 2";
// //      });
// //     Route::get('page3',function(){
// //         return "page 3";
// //      });
// // });
// // call controller
// #1
// Route::get('controller/{ten}', 'MyController@getData');
// #2 
// Route::get('controller/{ten}',[MyController::class,'getData']);
// // request
// Route::get('myrequest',[MyController::class,'getRequest']);
// // Request form with params
// Route::get('getform',[MyController::class, 'getForm'])->name('get-form');
// Route::post('postform',[MyController::class, 'postForm'])->name('post-form');
Route::prefix('admin')->group(function () {

  Route::middleware('accessadmin')->group(function () {
    Route::get('/', [adminRouter\Index::class, 'home'])->name('admin-home');
    // user group star
    Route::get('user/edit', [adminRouter\User::class, 'edit'])->name('user-edit');
    Route::get('user/remove/{id}', [adminRouter\User::class, 'remove'])->name('user-remove');
    Route::get('user/list', [adminRouter\User::class, 'list'])->name('user-list');
    Route::post('user/update', [adminRouter\User::class, 'update'])->name('user-update');
    Route::get('user/register', [adminRouter\User::class, 'register'])->name('user-register');
    Route::get('user/logout', [adminRouter\User::class, 'logout'])->name('user-logout');
    // user group end
    // category group star
    Route::get('category/edit', [adminRouter\category::class, 'edit'])->name('category-edit');
    Route::get('category/remove/{id}', [adminRouter\category::class, 'remove'])->name('category-remove');
    Route::get('category/list', [adminRouter\category::class, 'list'])->name('category-list');
    Route::post('category/update', [adminRouter\category::class, 'update'])->name('category-update');
    // category group end
    // product group star
    Route::get('product/edit', [adminRouter\product::class, 'edit'])->name('product-edit');
    Route::get('product/remove/{id}', [adminRouter\product::class, 'remove'])->name('product-remove');
    Route::get('product/list', [adminRouter\product::class, 'list'])->name('product-list');
    Route::post('product/update', [adminRouter\product::class, 'update'])->name('product-update');
    // product group end
    // post group star
    Route::get('post/edit', [adminRouter\post::class, 'edit'])->name('post-edit');
    Route::get('post/remove/{id}', [adminRouter\post::class, 'remove'])->name('post-remove');
    Route::get('post/list', [adminRouter\post::class, 'list'])->name('post-list');
    Route::post('post/update', [adminRouter\post::class, 'update'])->name('post-update');
    // post group end
    // post group star
    Route::get('layout/list/{type}', [adminRouter\layout::class, 'list'])->name('layout-list');
    Route::post('layout/update', [adminRouter\layout::class, 'update'])->name('layout-update');
    // post group end
    // website group star
    Route::get('website/edit', [adminRouter\website::class, 'edit'])->name('website-edit');
    Route::post('website/update', [adminRouter\website::class, 'update'])->name('website-update');
    // website group end
    // option group star
    Route::get('option/list/{type}', [adminRouter\option::class, 'list'])->name('option-list');
    Route::get('option/{type}/edit', [adminRouter\option::class, 'edit'])->name('option-edit');
    Route::post('option/update', [adminRouter\option::class, 'update'])->name('option-update');
    Route::get('option/remove/{id}', [adminRouter\option::class, 'remove'])->name('option-remove');
    // option group end
    // order start
    Route::get('order/list', [adminRouter\order::class, 'list'])->name('order-list');
    Route::get('order/edit/{id}', [adminRouter\order::class, 'edit'])->name('order-edit');
    Route::post('order/update/{id}', [adminRouter\order::class, 'update'])->name('order-update');
    // order end
  });
  Route::post('user/checklogin', [adminRouter\User::class, 'checkLogin'])->name('user-check');
  Route::get('user/login', [adminRouter\User::class, 'login'])->name('user-login');
  Route::post('admin_call_ajax', [adminRouter\Ajax::class, 'process'])->name('admin_call_ajax');
});

// Route::get('/{param1}.html', function ($param1) {
//   $controller = null;
//   foreach (categoryDB::all() as $key => $value) {
//     if ($value->url == $param1) {
//       $controller = $value->type;
//     }
//   }
//   foreach (postDB::all() as $key => $value) {
//     if ($value->url == $param1)
//     $controller = 'post-detail';
//   }
//   foreach (productDB::all() as $key => $value) {
//     if ($value->url == $param1)
//     $controller = 'product-detail';
//   }

//   if ($controller == null)
//     return view('welcome');
//   else
//     return redirect()->route('page',['page' => 1]);
// });
// Route::get('/{product}', 'product@getData')->name('product');
// Route::get('/{product-detail}', 'product@getDataDetail')->name('product-detail');
// Route::get('/{post}', 'post@getData')->name('post');
foreach (categoryDB::where('type', 'like', 'page')->get() as $key => $value) {
  Route::get('/' . $value->url . '.html', [uiRoute\Page::class, 'getData'])->name('page');
  Route::get('/' . $value->url, [uiRoute\Page::class, 'getData'])->name('page');
}
foreach (categoryDB::where('type', 'like', 'product')->get() as $key => $value) {
  Route::get('/' . $value->url . '.html', [uiRoute\Product::class, 'getData'])->name('product');
  Route::get('/' . $value->url, [uiRoute\Product::class, 'getData'])->name('product');
}
foreach (categoryDB::where('type', 'like', 'post')->get() as $key => $value) {
  Route::get('/' . $value->url . '.html', [uiRoute\Post::class, 'getData'])->name('post');
  Route::get('/' . $value->url, [uiRoute\Post::class, 'getData'])->name('post');
}

foreach (productDB::all() as $key => $value) {
  Route::get('/' . $value->url . '.html', [uiRoute\Product::class, 'getDataDetail'])->name('product-detail');
  Route::get('/' . $value->url, [uiRoute\Product::class, 'getDataDetail'])->name('product-detail');
}
foreach (postDB::all() as $key => $value) {
  Route::get('/' . $value->url . '.html', [uiRoute\post::class, 'getDataDetail'])->name('post-detail');
  Route::get('/' . $value->url, [uiRoute\post::class, 'getDataDetail'])->name('post-detail');
}

//cart start
Route::post('/add-to-cart', [uiRoute\Cart::class, 'addToCart'])->name('add-to-cart');
Route::post('/delete-cart', [uiRoute\Cart::class, 'deleteCart'])->name('delete-cart');
Route::post('/update-cart', [uiRoute\Cart::class, 'updateCart'])->name('update-cart');
Route::post('/save-cart', [uiRoute\Cart::class, 'saveCart'])->name('save-cart');
Route::get('/dat-hang-thanh-cong.html/{id}', [uiRoute\Cart::class, 'cartSuccess'])->name('cart-success');
Route::get('/gio-hang.html', [uiRoute\Cart::class, 'getData'])->name('view-cart');
Route::get('/gio-hang', [uiRoute\Cart::class, 'getData'])->name('view-cart');
//cart end
Route::get('/', [uiRoute\Index::class, 'getData']);
