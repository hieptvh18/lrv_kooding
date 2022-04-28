<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAttribute extends Model
{
    use HasFactory;
    protected $table = 'cate_attributes';

    protected $fillable = ['attr_id','cate_id'];

    public $timestamps = false;
}
