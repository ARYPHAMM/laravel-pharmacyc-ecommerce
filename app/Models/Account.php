<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
 

class Account extends Model implements Authenticatable
{
    use AuthenticableTrait;
    protected $primaryKey = 'id';
    protected $table = "tbl_account";
    public $timestamps = false;
    // public function post(){
    //     return $this->hasOne(Post::class,'account_id','id');
    // }
}