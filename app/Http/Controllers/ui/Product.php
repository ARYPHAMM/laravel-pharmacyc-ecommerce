<?php

namespace App\Http\Controllers\ui;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category as categoryDB;
use App\Models\Product as productDB;
use App\Models\TranslateProduct as translateProductDB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Route;

class Product extends Controller
{
    public function __construct(Controller $controller)
    {
        parent::__construct();
    }
    public function getData(Request $request)
    {
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
        $product = array();
        $product_where = productDB::whereRaw('FIND_IN_SET(?,category_id)', [$category->id])->get();
        $row_breadcrumb = array(
            $category->url => $title,
        ); // set breadcrumb 
        foreach ($product_where as $key => $r_product) {
            $product[] = productDB::find($r_product->id)->productDetail($this->default_lang_id);
        }
        // $product =  new Paginator($product,count($product),4,@$request->page);
        $total = count($product); // total count of the set, this is necessary so the paginator will know the total pages to display
        $page = $request->page ?? 1; // get current page from the request, first page is null
        $perPage = 3; // how many items you want to display per page?
        $offset = ($page - 1) * $perPage; // get the offset, how many items need to be "skipped" on this page
        $items = array_slice($product, $offset, $perPage); // the array that we actua
        $product =  new LengthAwarePaginator($items, $total, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query()
        ]);
        // $product->setPath($request->path());
        return view(config('app.template') . '.product', ['seo' => $seo, 'title' => $title, 'information' => $information, 'product' => $product, 'row_breadcrumb' => $row_breadcrumb]);
    }
    public function getDataDetail(Request $request)
    {
        $url = str_replace('.html', '', $request->path());
        $product = productDB::where('url', 'like', $url)->first()->productDetail($this->default_lang_id);
        $title = $product->title;
        // SEO start
        $seo['title'] = $title;
        $seo['thumbnail'] = $product->thumbnail;
        $seo['fav'] = $this->information->logo;
        $seo['keyword'] = $product->keyword;
        $seo['desc'] = $product->desc;
        $seo['h1'] = $product->h1;
        $seo['h2'] = $product->h2;
        $seo['h3'] = $product->h3;
        $information = $this->information->toArray();
        $row_breadcrumb = array();
        $where = explode(',', $product->category_id);
        $productRelated = [];
        foreach ($where as $id) {
            $productRelated[] = 'FIND_IN_SET(' . $id . ',category_id)';
            $row_breadcrumb[categoryDB::all()->find($id)->url] = categoryDB::all()->find($id)->categoryDetail($this->default_lang_id)->title;
        }
        $row_breadcrumb[$product->url] = $product->title;
        $productRelated = implode(' and ', $productRelated);
        $productRelated =  productDB::where('id', '!=', $product->id)->whereRaw($productRelated)->get();
        // dd($productRelated)
        foreach ($productRelated as $key => $value) {
            if ($value->id == $product->id)
                continue;
            $productRelated[$key] = productDB::find($value->id)->productDetail($this->default_lang_id);
        }
        return view(config('app.template') . '.product_detail', ['seo' => $seo, 'title' => $title, 'information' => $information, 'product' => $product, 'productRelated' => $productRelated, 'row_breadcrumb' => $row_breadcrumb]);
    }
}
