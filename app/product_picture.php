<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_picture extends Model
{
    protected $guarded = [];
    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}
