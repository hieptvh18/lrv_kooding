<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks'; //== pro_attributes old

    protected $fillable = ['pro_id','attr_id','attr_value_id','quantity'];

    // relationship
    public function products(){
        return $this->hasMany(Product::class,'pro_id');
    }
}
