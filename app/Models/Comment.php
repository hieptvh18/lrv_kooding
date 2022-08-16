<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = ['product_id', 'user_id', 'content','image'];

    // author
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
