<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TranslatePost extends Model
{
    protected $primarykey = 'id';
    protected $table ='tbl_tr_post';
    public $timestamps = false;
    Protected $guarded = [];
    public function post()
    {
        return $this->belongsTo(Post::class,'post_id','id');
    }
    public function lang()
    {
        return $this->belongsTo(Lang::class,'lang_id','id');
    }
}
