<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product;

class cart extends Model
{
    // use HasFactory;
    protected $fillable = [
        'users_id', 'products_id'    
    ];

    public function product()
    {
        return $this->hasMany(product::class, 'products_id', 'id');
    }
}
