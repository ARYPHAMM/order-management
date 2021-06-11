<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{ 
    protected $primaryKey = 'id';
    protected $table = "product";
    public $timestamps = false;
    protected $guarded = [];

    public function category_level_1()
    {
        return $this->belongsTo(Category::class,'category_id_1','id');
    }
    public function category_level_2()
    {
        return $this->belongsTo(Category::class,'category_id_2','id');
    }
    public function category_level_3()
    {
        return $this->belongsTo(Category::class,'category_id_3','id');
    }
}
