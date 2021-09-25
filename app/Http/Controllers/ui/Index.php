<?php

namespace App\Http\Controllers\ui;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\website;
use App\Models\Option;
use \Illuminate\Support\Facades\Config;

class Index extends Controller
{   
    public function __construct()
    {
        parent::__construct();
    }
    public function getData(){
        $title = $this->information->title;
        $seo['title'] = $this->information->title;
        $seo['thumbnail'] = $this->information->logo;
        $seo['fav'] = $this->information->logo;
        $seo['keyword'] = $this->information->keyword;
        $seo['desc'] = $this->information->desc;
        $seo['h1'] = $this->information->h1;
        $seo['h2'] = $this->information->h2;
        $seo['h3'] = $this->information->h3;
        $information = $this->information->toArray();

        $slider = Option::where('type','like','slide')->get();

        return view(config('app.template').'.index',['seo'=>$seo,'title'=>$title,'information' =>$information,'slider'=>$slider]);
    }
}
