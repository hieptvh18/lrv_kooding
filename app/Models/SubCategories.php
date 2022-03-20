<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    use HasFactory;
    protected $table = "sub_categories";

    // note: category_id 
    protected $fillable = ["name",'category_id','parent_id','sub_cate_slug','avatar'];
    
}
