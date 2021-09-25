<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $primaryKey = 'id';
    protected $table = "tbl_post";
    public $timestamps = false;
    // Protected $fillable = ['thumbnail','type'];
    protected $guarded = [];

    public function translates()
    {
        return $this->hasMany(TranslatePost::class, 'post_id', 'id');
    }
    public function postDetail($lang_id)
    {
        $post = $this->hasMany(TranslatePost::class, 'post_id', 'id')->join('tbl_post', 'tbl_tr_post.post_id','=', 'tbl_post.id')->where('tbl_tr_post.lang_id','like',$lang_id)->select('tbl_tr_post.*', 'tbl_post.thumbnail AS thumbnail','tbl_post.url AS url','tbl_post.category_id AS category_id','tbl_post.id AS id')->firstOrFail();
 
        return $post;
      
    }
    // public function postImagesExtend()
    // {
    //     return $this->hasMany(postExtend::class, 'post_id', 'id')->where('type', '=', 'images')->orderBy('id', 'ASC');
    // }

}
