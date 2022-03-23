<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['name','parent_id','slug','avatar'];
    
    // relationship
    public function attribites(){
        return $this->belongsTo(Attribute::class,'attr_id');
    }

    
    
}
