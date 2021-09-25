<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option as optionDB;
use App\Models\TranslateOption as translateOptionDB;

class Option extends Controller
{
    private $config_page = array();
    public function __construct(Controller $controller)
    {
        $this->config_page = array(
            'thumbnail' => array(
                'Hình danh mục' => 'thumbnail',
            ),
            'gallery' => array(
                'Thư viện hình ảnh' => 'gallery',
            ),
            'input' => array(
                'Tên option' => 'title',
            ),
            'text' => array(
                'Mô tả ngắn' => 'description',
            ),
            // 'editor' => array(
            //     'Nội dung' => 'content',
            // ),
            // 'checkbox' => array(
            //     'Danh mục sản phẩm' => array(
            //         'category_id' => categoryDB::where('type','like','product')->get()
            //     ),
            // ),
            // 'textSeo' => array(
            //     'Title seo' => 'title_seo',
            //     'Keyword seo' => 'keyword',
            //     'Description seo' => 'desc',
            //     'H1 seo' => 'h1',
            //     'H2 seo' => 'h2',
            //     'H3 seo' => 'h3',
            // ),
            // 'status' => array(
            //     'Hiển thị' => 'enable',
            //     'Nổi bật' => 'popular1',
            // )
        );
      
        // $this->account_current = $controller->account_current; #1
        parent::__construct(); #2 all method and variable
   }
   public function list($type){
     $items =  optionDB::where('type','like',$type)->paginate(10);
     return view('admin.option.list', ['items' => $items,'config_page' => $this->config_page,'type' => $type]);
   }
   public function edit(Request $request,$type)
   {
       $alert = array();
       $item = array();
       if (isset($request->id)) {
           $item = optionDB::find($request->id);
           $item_lang = array();
           //foreach(translateCategoryDB::where('category_id','like',$request->id)->get() as $r_item_lang){
           foreach($item->translates()->get() as $r_item_lang){
               $item_lang[$r_item_lang['lang_id']] = $r_item_lang->toArray();
           }
           return view('admin.option.edit', ['item' => $item,'item_lang' => $item_lang,'config_page' => $this->config_page, "lang" => $this->config_lang,'type' => $type]);
       } else {
           return view('admin.option.edit', ['config_page' => $this->config_page, "lang" => $this->config_lang,'type' => $type]);
       }
   }
   public function update(Request $request)
   {
       $data = array('thumbnail' =>null,'type' =>null);
       foreach ($data as $key => $r_data) {
          if($request->has($key)){
             $data[$key] = (is_array($request->$key)? implode(',',$request->$key) : $request->$key);
          }
       }
       if(@$request->id == ''){
           $option =  optionDB::create($data);

       }else{
           $option =  optionDB::find($request->id)->update($data);
           $option =  optionDB::find($request->id);
       }
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
               $dataTranslate[$r_lang['url']]['lang_id'] = $r_lang['id'];
               $dataTranslate[$r_lang['url']]['option_id'] = $option->id;
           }
       }

       foreach($dataTranslate as $key => $r_trl){
   
           if(@$request->id == ''){
               $r_trl =  translateOptionDB::create($r_trl);
           }else{
               $temp =  translateOptionDB::where('option_id','like',$r_trl['option_id'])->where('lang_id','like',$r_trl['lang_id'])->first();
              
               if($temp){
                   $temp->update($r_trl);
               }else{
                   $temp =  translateOptionDB::create($r_trl);
               }
           }
       }
   

       if(@$request->id == ''){
           $alert = array('title' => 'Thêm mới thành công!', 'status' => 'success');
           return redirect()->route('option-list',['type' => $request->type])->with('session-notification', $alert);
       }else{
           $alert = array('title' => 'Cập nhật thành công thành công!', 'status' => 'success');
           return back()->with('session-notification', $alert);
       }
  
   }
   public function remove($id)
   {
       $option = optionDB::find($id);
       $option->delete();
       $alert = array('title' => 'Xóa danh mục '.$option->username.' thành công!', 'status' => 'danger');
       return back()->with('session-notification', $alert);
   }
}