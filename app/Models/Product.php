<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id';
    protected $table = "tbl_product";
    public $timestamps = false;
    // Protected $fillable = ['thumbnail','type'];
    protected $guarded = [];

    public function translates()
    {
        return $this->hasMany(TranslateProduct::class, 'product_id', 'id');
      
    }
    public function productDetail($lang_id)
    {
        $product = $this->hasMany(TranslateProduct::class, 'product_id', 'id')->join('tbl_product', 'tbl_tr_product.product_id','=', 'tbl_product.id')->where('tbl_tr_product.lang_id','like',$lang_id)->select('tbl_tr_product.*', 'tbl_product.thumbnail AS thumbnail','tbl_product.url AS url','tbl_product.category_id AS category_id','tbl_product.id AS id')->firstOrFail();
        $productExtend = ProductExtend::where('product_id','like',$product->id);
        $product['images'] = $productExtend->get();
        return $product;
    }
  
    public function productImagesExtend()
    {
        return $this->hasMany(ProductExtend::class, 'product_id', 'id')->where('type', '=', 'images')->orderBy('id', 'ASC');
    }
}
