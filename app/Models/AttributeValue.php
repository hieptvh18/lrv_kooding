<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    protected $table = 'attr_values';

    protected $fillable = ['attr_id','value','name'];

    public $timestamps = false;

    // realtion ship eloquent

    // lấy thông tin của lớp cha attr
    public function attributes(){
        return $this->belongsTo(Attribute::class,'attr_id');
    }   
}
