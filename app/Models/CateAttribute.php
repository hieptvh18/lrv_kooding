<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CateAttribute extends Model
{
    use HasFactory;

    protected $table = 'cate_attributes';

    public $timestamps = false;
}
