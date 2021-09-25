<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;

class website extends Model
{
    protected $primaryKey = 'id';
    protected $table = "tbl_website";
    public $timestamps = false;
    // Protected $fillable = ['thumbnail','type'];
    protected $guarded = [];
}
