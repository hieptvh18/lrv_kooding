<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks'; //== pro_attributes old

    protected $fillable = ['pro_id','color_id','size_id','material_id','quantity','sku'];

    // relationship
    public function products(){
        return $this->hasOne(Product::class,'pro_id');
    }

    // rela attr , attr_value
    public function attributeValues(){
        return $this->belongsToMany(AttributeValue::class,['color_id','size_id','material_id']);
    }
}
