<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TranslateProduct extends Model
{
    protected $primarykey = 'id';
    protected $table ='tbl_tr_product';
    public $timestamps = false;
    Protected $guarded = [];
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function lang()
    {
        return $this->belongsTo(Lang::class,'lang_id','id');
    }
}
