<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [];
    
    // relationship
    public function categories(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function brands(){
        return $this->belongsTo(Brand::class,'brand_id');
    }

    
}
