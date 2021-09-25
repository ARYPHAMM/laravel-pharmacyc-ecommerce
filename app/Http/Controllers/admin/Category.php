<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Category as categoryDB;
use App\Models\TranslateCategory as translateCategoryDB;
use Illuminate\Support\Facades\View;
// use Illuminate\Pagination\Paginator;

class Category extends Controller
{
    private $config_page = array(
        'thumbnail' => array(
            'Hình danh mục' => 'thumbnail',
        ),
        'gallery' => array(
            'Thư viện hình ảnh' => 'gallery',
        ),
        'input' => array(
            'Tên sản phẩm' => 'title',
        ),
        'text' => array(
            'Mô tả ngắn' => 'description',
        ),
        'editor' => array(
            'Nội dung' => 'content',
        ),
        'select' => array(
            'Danh mục' =>  array(
                'default' => "type",
                'Sản phẩm' => "product",
                'Bài viết' => "post",
                'Trang' => "page"
            ),
        ),
        'checkbox' => array(
            'Danh mục cha' => array(
                'category_id' => array()
            ),
        ),
        'textSeo' => array(
            'Title seo' => 'title_seo',
            'Keyword seo' => 'keyword',
            'Description seo' => 'desc',
            'H1 seo' => 'h1',
            'H2 seo' => 'h2',
            'H3 seo' => 'h3',
        ),
        'status' => array(
            'Hiển thị' => 'enable',
            'Nổi bật' => 'popular1',
        )
    );
    public function __construct(Controller $controller)
    {

        // $this->account_current = $controller->account_current; #1
        parent::__construct(); #2 all method and variable
    }

    public function edit(Request $request)
    {
        $alert = array();
        $item = array();
        if (isset($request->id)) {
            $item = categoryDB::find($request->id);
            $item_lang = array();
            //foreach(translateCategoryDB::where('category_id','like',$request->id)->get() as $r_item_lang){
            foreach($item->translates()->get() as $r_item_lang){
                $item_lang[$r_item_lang['lang_id']] = $r_item_lang->toArray();
            }
            return view('admin.category.edit', ['item' => $item,'item_lang' => $item_lang,'config_page' => $this->config_page, "lang" => $this->config_lang]);
        } else {
            return view('admin.category.edit', ['config_page' => $this->config_page, "lang" => $this->config_lang]);
        }
    }
    public function remove($id)
    {
        $category = categoryDB::find($id);
        $category->delete();
        $alert = array('title' => 'Xóa danh mục '.$category->username.' thành công!', 'status' => 'danger');
        return back()->with('session-notification', $alert);

    }
    public function list()
    {
        $items = translateCategoryDB::where('lang_id','like',$this->default_lang_id)->paginate(10);

     // $paginate = 1;
        // $page = request('page',1);
        // $slice = array_slice($items, $paginate * ($page - 1), $paginate);
        // $items = new Paginator($slice, count($items), $paginate);

        return view('admin.category.list', ['items' => $items,'config_page' => $this->config_page]);
    }
    public function update(Request $request)
    {
        $data = array('thumbnail' =>null,'type'=>null,'url'=>null,'enable'=>null,'popular1'=>null);
        foreach ($data as $key => $r_data) {
           if($request->has($key)){
             
              $data[$key] = $request->$key;
           }
        }
        if(@$request->id == ''){
            $category =  categoryDB::create($data);

        }else{
            $category =  categoryDB::find($request->id)->update($data);
            $category =  categoryDB::find($request->id);
        }
        $dataTranslate = array();
        foreach ($this->config_lang as $r_lang) { // loop lang current page
            foreach ($request->except('_token') as $key_request => $r_param) { // loop request give params
                foreach ($this->config_page['input'] as $key_config) { // loop config data insert and update
                    if ($key_config . '_' . $r_lang['url'] == $key_request) {
                        $dataTranslate[$r_lang['url']][$key_config] = $r_param;
                        if($key_config == 'title' && $r_lang['url'] == 'vn'){ // create url path
                            $data['url'] = changeTitle($r_param);
                        }
                    }
                }
                foreach ($this->config_page['text'] as $key_config) { // loop config data insert and update
                    if ($key_config . '_' . $r_lang['url'] == $key_request) {
                        $dataTranslate[$r_lang['url']][$key_config] = $r_param;
                    }
                }
                foreach ($this->config_page['editor'] as $key_config) { // loop config data insert and update
                    if ($key_config . '_' . $r_lang['url'] == $key_request) {
                        $dataTranslate[$r_lang['url']][$key_config] = $r_param;
                    }
                }
                foreach ($this->config_page['textSeo'] as $key_config) { // loop config data insert and update
                    if ($key_config . '_' . $r_lang['url'] == $key_request) {
                        $dataTranslate[$r_lang['url']][$key_config] = $r_param;
                    }
                }
                $dataTranslate[$r_lang['url']]['lang_id'] = $r_lang['id'];
                $dataTranslate[$r_lang['url']]['category_id'] = $category->id;
            }
        }
        foreach($dataTranslate as $key => $r_trl){
    
            if(@$request->id == ''){
                $r_trl =  translateCategoryDB::create($r_trl);
            }else{
                $temp =  translateCategoryDB::where('category_id','like',$r_trl['category_id'])->where('lang_id','like',$r_trl['lang_id'])->first();
               
                if($temp){
                    $temp->update($r_trl);
                }else{
                    $temp =  translateCategoryDB::create($r_trl);
                }
            }
        }
    
        $temp = categoryDB::find($category->id)->update($data);

        if(@$request->id == ''){
            $alert = array('title' => 'Thêm mới thành công!', 'status' => 'success');
            return redirect()->route('category-list')->with('session-notification', $alert);
        }else{
            $alert = array('title' => 'Cập nhật thành công thành công!', 'status' => 'success');
            return back()->with('session-notification', $alert);
        }
   
    }
}