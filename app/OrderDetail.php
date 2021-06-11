<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table ="order_detail";
    protected $primaryKey = 'id';
    public $timestamps = true;
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
