<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebSetting extends Model
{
    use HasFactory;

    protected $table = 'web_settings';
    protected $fillable = ['web_name','intro_title','intro_content','logo','fb_url','insta_url','twitter_url','pinterest_url'];
}
