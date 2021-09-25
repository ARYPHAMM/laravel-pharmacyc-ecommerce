<?php

namespace App\Http\Controllers\ui;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Category as categoryDB;

class Page extends Controller
{
    public function getData(Request $request){
        $url = str_replace('.html', '', $request->path());
        $category = categoryDB::where('url', 'like', $url)->first()->categoryDetail($this->default_lang_id);
        // SEO start
        $title = $category->title;
        $seo['title'] =  $category->title;
        $seo['thumbnail'] = $category->thumbnail;
        $seo['fav'] = $this->information->logo;
        $seo['keyword'] = $category->keyword;
        $seo['desc'] = $category->desc;
        $seo['h1'] = $category->h1;
        $seo['h2'] = $category->h2;
        $seo['h3'] = $category->h3;
        $information = $this->information->toArray();
        // SEO end
        $row_breadcrumb = array(
            $category->url => $title,
        ); // set breadcrumb 

        return view(config('app.template') . '.page', ['seo' => $seo, 'title' => $title, 'information' => $information, 'category' => $category, 'row_breadcrumb' => $row_breadcrumb]);
    }
}
