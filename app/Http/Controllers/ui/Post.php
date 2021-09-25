<?php

namespace App\Http\Controllers\ui;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Models\Post as postDB;
use App\Models\Category as categoryDB;

class Post extends Controller
{
    public function __construct()
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
        $post = array();
        $post_where = postDB::whereRaw('FIND_IN_SET(?,category_id)', [$category->id])->get();
        $row_breadcrumb = array(
            $category->url => $title,
        ); // set breadcrumb 
        foreach ($post_where as $key => $r_post) {
            $post[] = postDB::find($r_post->id)->postDetail($this->default_lang_id);
        }
        // $post =  new Paginator($post,count($post),4,@$request->page);
        $total = count($post); // total count of the set, this is necessary so the paginator will know the total pages to display
        $page = $request->page ?? 1; // get current page from the request, first page is null
        $perPage = 3; // how many items you want to display per page?
        $offset = ($page - 1) * $perPage; // get the offset, how many items need to be "skipped" on this page
        $items = array_slice($post, $offset, $perPage); // the array that we actua
        $post =  new LengthAwarePaginator($items, $total, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query()
        ]);
        
        // $post->setPath($request->path());
        return view(config('app.template') . '.post', ['seo' => $seo, 'title' => $title, 'information' => $information, 'post' => $post, 'row_breadcrumb' => $row_breadcrumb,'category' => $category]);
    }
    public function getDataDetail(Request $request){
        $url = str_replace('.html', '', $request->path());
        $post = postDB::where('url', 'like', $url)->first()->postDetail($this->default_lang_id);
        $title = $post->title;
        // SEO start
        $seo['title'] = $title;
        $seo['thumbnail'] = $post->thumbnail;
        $seo['fav'] = $this->information->logo;
        $seo['keyword'] = $post->keyword;
        $seo['desc'] = $post->desc;
        $seo['h1'] = $post->h1;
        $seo['h2'] = $post->h2;
        $seo['h3'] = $post->h3;
        $information = $this->information->toArray();
        $where = explode(',', $post->category_id);
        $row_breadcrumb = array();

        $postRelated = [];
        foreach ($where as $id) {
            $postRelated[] = 'FIND_IN_SET(' . $id . ',category_id)';
            $row_breadcrumb[categoryDB::all()->find($id)->url] = categoryDB::all()->find($id)->categoryDetail($this->default_lang_id)->title;
        }
        $row_breadcrumb[$post->url] = $post->title;

        $postRelated = implode(' and ', $postRelated);
        $postRelated =  postDB::where('id', '!=', $post->id)->whereRaw($postRelated)->get();
        // dd($postRelated)
        foreach ($postRelated as $key => $value) {
            if($value->id == $post->id)
              continue;
          $postRelated[$key] = postDB::find($value->id)->postPost($this->default_lang_id);
        }        
        return view(config('app.template') . '.post_detail', ['seo' => $seo, 'title' => $title, 'information' => $information, 'post' => $post,'postRelated' => $postRelated,'row_breadcrumb' => $row_breadcrumb]);
    }
}
