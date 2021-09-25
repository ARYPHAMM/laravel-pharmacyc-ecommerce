<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class layout extends Model
{
    protected $primaryKey = 'id';
    protected $table = "tbl_layout";
    public $timestamps = false;
    // Protected $fillable = ['thumbnail','type'];
    protected $guarded = [];


}
