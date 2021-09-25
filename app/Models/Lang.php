<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    protected $primaryKey = 'id';
    protected $table = "tbl_lang";
    public $timestamps = false;
    public function translateCategory()
    {
        return $this->hasMany(TranslateCategory::class,'lang_id','id');
    }
    public function translateProduct()
    {
        return $this->hasMany(TranslateCategory::class,'lang_id','id');
    }
}