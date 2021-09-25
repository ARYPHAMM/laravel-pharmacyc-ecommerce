<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TranslateOption extends Model
{
    protected $primarykey = 'id';
    protected $table ='tbl_tr_option';
    public $timestamps = false;
    Protected $guarded = [];
    public function option()
    {
        return $this->belongsTo(Option::class,'option_id','id');
    }
    public function lang()
    {
        return $this->belongsTo(Lang::class,'lang_id','id');
    }
}
