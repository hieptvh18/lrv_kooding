<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BinaryCats\Sku\HasSku;
use BinaryCats\Sku\Concerns\SkuOptions;



class Stock extends Model
{
    // generate sku
    use HasSku;
    use HasFactory;

    protected $table = 'stocks'; //== pro_attributes old

    protected $fillable = ['pro_id','name','color_id','size_id','material_id','quantity'];

    // relationship
    public function products(){
        return $this->belongsTo(Product::class,'pro_id');
    }

    // rela attr , attr_value
    public function colors(){
        return $this->hasOne(AttributeValue::class,'color_id');
    }
    

    // ghi de field render sku
   
}
