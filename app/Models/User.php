<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'gender',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // admin role
    public function isAdministrator() {
        return $this->roles()->where('id', 2)->where('id',3)->exists();
     }

    // relationship

    public function roles(){
        return $this->belongsTo(Role::class,'role_id');
    }


    // get value config
    function getStrRole(){
        $perrmissionMapping =  array_flip(config('permission'));

        // this laf ng dung hien tai
        // tra ve value la string tu role_id 
        return $perrmissionMapping[$this->role_id];
    }
}
