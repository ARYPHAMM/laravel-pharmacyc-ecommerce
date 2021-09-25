<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\website as websiteDB;

class Website extends Controller
{
    private $config_page = array();
    public function __construct(Controller $controller)
    {
        $this->config_page = array(
            'logo' => array(
                'Icon' => 'logo',
            ),

            'input' => array(
                'Tên sản phẩm' => 'title',
            ),
            // 'text' => array(
            //     'Mô tả ngắn' => 'description',
            // ),
            // 'editor' => array(
            //     'Nội dung' => 'content',
            // ),
            // 'checkbox' => array(
            //     'Danh mục sản phẩm' => array(
            //         'category_id' => categoryDB::where('type','like','product')->get()
            //     ),
            // ),
            'textSeo' => array(
                'Title seo' => 'title_seo',
                'Keyword seo' => 'keyword',
                'Description seo' => 'desc',
                'H1 seo' => 'h1',
                'H2 seo' => 'h2',
                'H3 seo' => 'h3',
            )
        );
      
        // $this->account_current = $controller->account_current; #1
        parent::__construct(); #2 all method and variable
    }
    public function edit(Request $request){
        $alert = array();
        $data = websiteDB::all();
        $item_lang = array();
        foreach ($data as $r) {
            $item_lang[$r->lang_id] = $r->toArray();
        }
        return view('admin.website.edit', ['item_lang' => $item_lang,'config_page' => $this->config_page, "lang" => $this->config_lang]);
     }
     public function update(Request $request)
     {
         $website = websiteDB::query()->delete();
         $dataTranslate = array();
         foreach ($this->config_lang as $r_lang) { // loop lang current page
             foreach ($request->except('_token') as $key_request => $r_param) { // loop request give params
                 foreach ($this->config_page as $arr_config) { // loop config data insert and update
                    foreach($arr_config as $key_config){
                        if ($key_config . '_' . $r_lang['url'] == $key_request) {
                            $dataTranslate[$r_lang['url']][$key_config] = $r_param;
                        }
                    }
                 }
             }
             $dataTranslate[$r_lang['url']]['lang_id'] = $r_lang['id'];
         }
         foreach ($dataTranslate as $r_data) {
            $r_data = websiteDB::create($r_data);
         }
         return back();
     }
}
