<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\cart;

class product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id','name','price','description'
    ];

    public function cart()
    {
        return $this->belongsTo(cart::class);
    }

    public function addedtocart()
    {
        return $this->hasMany(addedtocart::class);
    }

}
