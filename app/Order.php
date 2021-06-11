<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table ="order";
     protected $primaryKey = 'id';
     public $timestamps = true;
     protected $guarded = [];
     public function customer()
     {
      
         return $this->belongsTo(Customer::class, 'customer_id', 'id');
       
     }
     public function orderDetail()
     {
         return $this->hasMany(OrderDetail::class, 'order_id', 'id')->get();
     }
     public function totalPrice()
     { 
         $arr = $this->hasMany(OrderDetail::class, 'order_id', 'id')->get();
         $total = 0;
         foreach ($arr as  $item) {
             $total += $item->price;
         }
         return number_format($total,0).'đ';
     }
}
