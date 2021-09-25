<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $primaryKey = 'id';
    protected $table = "tbl_order_detail";
    public $timestamps = true;
    // Protected $fillable = ['thumbnail','type'];
    protected $guarded = [];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
