<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product as productDB;
use App\Models\ProductExtend as productExtendDB;
use App\Models\Category as categoryDB;
use App\Models\TranslateProduct as translateProductDB;
use Illuminate\Support\Facades\View;

class Product extends Controller
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
                'Tên sản phẩm' => 'title',
            ),
            'number' => array(
                'Giá bán' => 'price_sale',
                'Giá góc' => 'price',
            ),
            'text' => array(
                'Mô tả ngắn' => 'description',
            ),
            'editor' => array(
                'Nội dung' => 'content',
            ),
            'checkbox' => array(
                'Danh mục sản phẩm' => array(
                    'category_id' => categoryDB::where('type', 'like', 'product')->get()
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
                'Hiển thị trang chủ' => 'popular1',
                'Sản phẩm bán chạy' => 'popular2'
            )
        );

        // $this->account_current = $controller->account_current; #1
        parent::__construct(); #2 all method and variable
    }

    public function edit(Request $request)
    {
        $alert = array();
        $item = array();
        if (isset($request->id)) {
            $item = productDB::find($request->id);
            $item_lang = array();
            //foreach(translateCategoryDB::where('category_id','like',$request->id)->get() as $r_item_lang){
            foreach ($item->translates()->get() as $r_item_lang) {
                $item_lang[$r_item_lang['lang_id']] = $r_item_lang->toArray();
            }
            return view('admin.product.edit', ['item' => $item, 'item_lang' => $item_lang, 'config_page' => $this->config_page, "lang" => $this->config_lang]);
        } else {
            return view('admin.product.edit', ['config_page' => $this->config_page, "lang" => $this->config_lang]);
        }
    }
    public function remove($id)
    {
        $product = productDB::find($id);
        $product->delete();
        $alert = array('title' => 'Xóa danh mục ' . $product->username . ' thành công!', 'status' => 'danger');
        return back()->with('session-notification', $alert);
    }
    public function list()
    {
        $items = translateProductDB::where('lang_id', 'like', $this->default_lang_id)->paginate(10);

        // $paginate = 1;
        // $page = request('page',1);
        // $slice = array_slice($items, $paginate * ($page - 1), $paginate);
        // $items = new Paginator($slice, count($items), $paginate);

        return view('admin.product.list', ['items' => $items, 'config_page' => $this->config_page]);
    }
    public function update(Request $request)
    {
        $data = array('thumbnail' => null, 'url' => null, 'enable' => null, 'popular1' => null, 'category_id' => null);

        foreach ($data as $key => $r_data) {
            if ($request->has($key)) {
                $data[$key] = (is_array($request->$key) ? implode(',', $request->$key) : $request->$key);
            }
        }
        if (@$request->id == '') {
            $product =  productDB::create($data);
        } else {
            $product =  productDB::find($request->id)->update($data);
            $product =  productDB::find($request->id);
        }
        $dataTranslate = array();
        foreach ($this->config_lang as $r_lang) { // loop lang current page
            foreach ($request->except('_token') as $key_request => $r_param) { // loop request give params
                foreach ($this->config_page['input'] as $key_config) { // loop config data insert and update
                    if ($key_config . '_' . $r_lang['url'] == $key_request) {
                        $dataTranslate[$r_lang['url']][$key_config] = $r_param;
                        if ($key_config == 'title' && $r_lang['url'] == 'vn') { // create url path
                            $data['url'] = changeTitle($r_param);
                        }
                    }
                }
                foreach ($this->config_page['text'] as $key_config) { // loop config data insert and update
                    if ($key_config . '_' . $r_lang['url'] == $key_request) {
                        $dataTranslate[$r_lang['url']][$key_config] = $r_param;
                    }
                }
                foreach ($this->config_page['number'] as $key_config) { // loop config data insert and update
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
                $dataTranslate[$r_lang['url']]['product_id'] = $product->id;
            }
        }

        foreach ($dataTranslate as $key => $r_trl) {

            if (@$request->id == '') {
                $r_trl =  translateProductDB::create($r_trl);
            } else {
                $temp =  translateProductDB::where('product_id', 'like', $r_trl['product_id'])->where('lang_id', 'like', $r_trl['lang_id'])->first();

                if ($temp) {
                    $temp->update($r_trl);
                } else {
                    $temp =  translateProductDB::create($r_trl);
                }
            }
        }

        $temp = productDB::find($product->id)->update($data); // update url
        $productExtend =  productExtendDB::where('product_id', 'like', $product->id)->where('type', 'like', 'images')->delete(); // gallery start
        if ($request->has('image')) {
            foreach ($request->image as  $r_image) {
                productExtendDB::create(array('thumbnail' => $r_image, 'product_id' => $product->id, "type" => "images"));
            }
        } // gallery end
        if (@$request->id == '') {
            $alert = array('title' => 'Thêm mới thành công!', 'status' => 'success');
            return redirect()->route('product-list')->with('session-notification', $alert);
        } else {
            $alert = array('title' => 'Cập nhật thành công thành công!', 'status' => 'success');
            return back()->with('session-notification', $alert);
        }
    }
}
