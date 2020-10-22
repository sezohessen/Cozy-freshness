<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function categoryActive()
    {
        return $this->belongsTo(Category::class)->where('active',1);
    }
    public function pictures()
    {
        return $this->hasMany(product_picture::class);
    }
    public static function active($id = NULL)
    {
        if($id == NULL){
            return self::where('active', 1);
        }else{
            return self::where('active', 1)
            ->where('category_id', $id);
        }
    }
}
