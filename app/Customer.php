<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
     protected $table ="customer";
     protected $primaryKey = 'id';
     public $timestamps = true;
     protected $guarded = [];
     public function orders()
     {
      
         return $this->hasMany(Order::class, 'customer_id', 'id');
       
     }

}
