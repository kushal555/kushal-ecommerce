<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['product_name', 'description', 'image' , 'category_id' , 'subcategory_id', 'price' , 'status' ];


    protected $casts = [
      'status'  => 'boolean'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class,'subcategory_id');
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value?1:0;
    }
}
