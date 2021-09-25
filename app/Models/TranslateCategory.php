<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TranslateCategory extends Model
{
    protected $primarykey = 'id';
    protected $table ='tbl_tr_category';
    public $timestamps = false;
    Protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function lang()
    {
        return $this->belongsTo(Lang::class,'lang_id','id');
    }

}
