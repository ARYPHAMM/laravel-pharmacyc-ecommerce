<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductExtend extends Model
{
    protected $table = 'tbl_product_extend';
    protected $primarykey = 'id';
    public $timestamps = false;
    Protected $guarded = [];
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    // public function lang()
    // {
    //     return $this->belongsTo(Lang::class,'lang_id','id');
    // }

}
