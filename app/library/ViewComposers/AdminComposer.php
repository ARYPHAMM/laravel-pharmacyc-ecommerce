<?php

namespace App\Library\ViewComposers;


use Illuminate\View\View;
use Illuminate\Support\Facades\Schema;
use App\Library\helper;
use Illuminate\Support\Facades\Cookie;
use App\Models\Account;
use App\Models\Lang;

class AdminComposer
{
    public function compose(View $view)
    {
        $config_menu = array(
            "Tài khoản" => array(
                "com" => "user",
                "icon" => "fas fa-user",
                "child" => array(array("act" => "list", "type" => "default", "title" => "Danh sách tài khoản"))
            ),
            "Danh mục" => array(
                "com" => "category",
                "icon" => "fas fa-list",
                "child" => array(array("act" => "list", "type" => "default", "title" => "Danh sách danh mục"))
            ),
            "Sản phẩm" => array(
                "com" => "product",
                "icon" => "fas fa-box-open",
                "child" => array(array("act" => "list", "type" => "default", "title" => "Danh sách sản phẩm"))
            ),
            "Đơn hàng" => array(
                "com" => "order",
                "icon" => "fas fa-box-open",
                "child" => array(array("act" => "list", "type" => "default", "title" => "Danh sách Đơn hàng"))
            ),
            "Hình ảnh và liên kết" => array(
                "com" => "option",
                "icon" => "fas fa-image",
                "child" => array(array("act" => "list", "type" => "slide", "title" => "Slide trang chủ"))
            ),
            "Bài viết" => array(
                "com" => "post",
                "icon" => "fas far fa-newspaper",
                "child" => array(array("act" => "list", "type" => "default", "title" => "Danh sách bài viết"))
            ),
            "Bố cục" => array(
                "com" => "layout",
                "icon" => "fas fa-border-all",
                "child" => array(
                    array("act" => "list", "type" => "index", "title" => "Trang chủ"),
                    array("act" => "list", "type" => "header", "title" => "Header"),
                    array("act" => "list", "type" => "footer", "title" => "Footer")

                )
            ),
            "Website" => array(
                "com" => "website",
                "icon" => "fas fa-border-all",
                "child" => array(array("act" => "edit", "type" => "default", "title" => "Thông tin website"))
            )
        );
        if (Schema::hasTable('tbl_lang')) {
            $config_lang = Lang::all(); // config lang system
            $view->with('config_menu', $config_menu);
            if (Cookie::get('admin') !== '') {
                $account_current = Account::where('email', Cookie::get('admin'))->first();
                $view->with('account_current', $account_current);
                $view->with('config_lang', $config_lang);
                $view->with('lang_current', $config_lang->where('default', 1)->first());
                // Config::set('something', $something); 
            }
        }
    }
}
