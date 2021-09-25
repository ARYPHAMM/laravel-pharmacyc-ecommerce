<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'id';
    protected $table = "tbl_order";
    public $timestamps = true;
    // Protected $fillable = ['thumbnail','type'];
    protected $guarded = [];
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
