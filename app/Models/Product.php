<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['name','slug','category_id','price','discount','brand_id','avatar','description','status'];
    
    // relationship
    public function categories(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function brands(){
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function images(){
        return $this->hasMany(ProductImage::class,'pro_id');
    }
    
    public function stocks(){
        return $this->hasMany(Stock::class,'pro_id');
    }

    
}
