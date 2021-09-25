<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cookie;
use App\Models\Account;
use App\Models\Lang;
use App\Models\website;
use \Illuminate\Support\Facades\Config;
use \Illuminate\Support\Facades\View;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $account_current;
    protected $config_lang;
    protected $default_lang_id;
    protected $information;
    public function __construct()
    {  
        
        if (Cookie::get('admin') !== '') {
            $this->account_current = Account::where('email', Cookie::get('admin'))->first();   
            $this->config_lang = Lang::all();
        }
        $this->default_lang_id = Lang::where('default',1)->firstOrFail()->id;
        $this->information = website::where('lang_id','like',$this->default_lang_id)->first();
    }
}
