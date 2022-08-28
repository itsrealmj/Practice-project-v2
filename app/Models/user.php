<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\user as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

                    // new
class user extends Authenticatable
{       //new                       //new
    use HasApiTokens, HasFactory, Notifiable;
    //new
    protected $guarded = [];
    // new
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function addedtocart()
    {
        return $this->hasMany(addedtocart::class);
    }

}
