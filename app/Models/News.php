<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = ['title','content','image','author_id','short_desc'];

    public function authors(){
        return $this->belongsTo(User::class,'author_id');
    }
}
