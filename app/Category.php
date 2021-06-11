<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];
    public function productsLevel1()
    {
        return $this->hasMany(Product::class, 'category_id_1', 'id');
      
    }
    public function productsLevel2()
    {
        return $this->hasMany(Product::class, 'category_id_2', 'id');
      
    }
    public function productsLevel3()
    {
        return $this->hasMany(Product::class, 'category_id_3', 'id');
      
    }
    public function categoryLevel1()
    {
        return $this->belongsTo(category::class, 'level_id_1', 'id');
      
    }
    public function categoryLevel2()
    {
        return $this->belongsTo(category::class, 'level_id_2', 'id');
      
    }
    public function categoryLevel3()
    {
        return $this->belongsTo(category::class, 'level_id_3', 'id');
      
    }

}
