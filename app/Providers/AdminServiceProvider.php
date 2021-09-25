<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\helper;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Schema;
use App\Models\Account;
use App\Models\Lang;

class AdminServiceProvider extends ServiceProvider
{
    public function register()
    {
    }
    public function boot()
    {
        View::composer( //#1
            [
                'admin.*',	
            ], 
            'App\Library\ViewComposers\AdminComposer' // composer class name
        );
        // View::composer('*', function($view) #2
        // {
        //     $view->with('current_user', Auth::user());
        // });
        // $config_menu = array(
        //     "Tài khoản" => array(
        //         "com" => "user",
        //         "icon" => "fas fa-user",
        //         "child" => array(array("act" => "list", "type" => "default", "title" => "Danh sách tài khoản"))
        //     ),
        //     "Danh mục" => array(
        //         "com" => "category",
        //         "icon" => "fas fa-list",
        //         "child" => array(array("act" => "list", "type" => "default", "title" => "Danh sách danh mục"))
        //     ),
        //     "Sản phẩm" => array(
        //         "com" => "product",
        //         "icon" => "fas fa-box-open",
        //         "child" => array(array("act" => "list", "type" => "default", "title" => "Danh sách sản phẩm"))
        //     ),
        //     "Hình ảnh và liên kết" => array(
        //         "com" => "option",
        //         "icon" => "fas fa-image",
        //         "child" => array(array("act" => "list", "type" => "slide", "title" => "Slide trang chủ"))
        //     ),
        //     "Bài viết" => array(
        //         "com" => "post",
        //         "icon" => "fas far fa-newspaper",
        //         "child" => array(array("act" => "list", "type" => "default", "title" => "Danh sách bài viết"))
        //     ),
        //     "Bố cục" => array(
        //         "com" => "layout",
        //         "icon" => "fas fa-border-all",
        //         "child" => array(array("act" => "list", "type" => "index", "title" => "Trang chủ"),
        //         array("act" => "list", "type" => "header", "title" => "Header"))
        //     ),
        //     "Website" => array(
        //         "com" => "website",
        //         "icon" => "fas fa-border-all",
        //         "child" => array(array("act" => "edit", "type" => "default", "title" => "Thông tin website"))
        //     )
        // );
        // if (Schema::hasTable('tbl_lang')) {
        //     $config_lang = Lang::all(); // config lang system
        //     View::share('config_menu', $config_menu);
        //     if (Cookie::get('admin') !== '') {
        //         $account_current = Account::where('email', Cookie::get('admin'))->first();
        //         View::share('account_current', $account_current);
        //         View::share('config_lang', $config_lang);
        //         View::share('lang_current', $config_lang->where('default',1)->first());
        //         // if you need to access in controller and views:
        //         // Config::set('something', $something); 
        //     }
        // }
    }
}
