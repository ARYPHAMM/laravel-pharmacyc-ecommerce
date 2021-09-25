<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;


class Category extends Model
{
    protected $primaryKey = 'id';
    protected $table = "tbl_category";
    public $timestamps = false;
    // Protected $fillable = ['thumbnail','type'];
    protected $guarded = [];

    public function translates()
    {
        return $this->hasMany(TranslateCategory::class, 'category_id', 'id');
    }
    public function categoryDetail($lang_id)
    {
        $category = $this->hasMany(TranslateCategory::class, 'category_id', 'id')->join('tbl_category', 'tbl_tr_category.category_id','=', 'tbl_category.id')->where('tbl_tr_category.lang_id','like',$lang_id)->select('tbl_tr_category.*', 'tbl_category.thumbnail AS thumbnail','tbl_category.url AS url','tbl_category.id AS id')->firstOrFail();
      
        return $category;
    }
    // public function translatesFull()
    // {
    //     $tr_category = $this->translates();
    //     foreach ($tr_category as $key => $value) {
    //       $value->thumbnail = $value->category->thumbnail;
    //       $value->uri = $value->category->url;
    //     }
    // }
    public function delete()
    {
        // delete all related photos 
        $this->translates()->delete();
        // as suggested by Dirk in comment,
        // it's an uglier alternative, but faster
        // Photo::where("user_id", $this->id)->delete()

        // delete the user
        return parent::delete();
    }
    // public static function getList()
    // {
    //     $obj = new TranslateCategory();
    //     $data = array();
    //     foreach (Category::all() as  $r_category) {
    //         foreach ($r_category->translates()->get() as $r_tr_category) {
    //                       if($r_tr_category->lang()->get()->first()->url == 'vn'){
    //                         $r_tr_category->thumbnail = $r_category->first()->url;
    //                         $data[] = $r_tr_category;
                            
    //                       }
            
    //         }
    //     }
    //     return $obj->newInstance($data,true);
    // }
}
