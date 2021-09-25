<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $primaryKey = 'id';
    protected $table = "tbl_option";
    public $timestamps = false;
    // Protected $fillable = ['thumbnail','type'];
    protected $guarded = [];
    public function translates()
    {
        return $this->hasMany(TranslateOption::class, 'option_id', 'id');
    }

}
