<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['name','parent_id','slug','avatar'];
    
    // relationship many to many(4 paeamerter: 1:class name, table middle,id refer table middle, id refer table middle)
    public function attributes(){
        return $this->belongsToMany(Attribute::class,'cate_attributes','category_id','attr_id');
    }     

    public function products(){
        return $this->hasMany(Product::class,'category_id');
    }

    
    
}
