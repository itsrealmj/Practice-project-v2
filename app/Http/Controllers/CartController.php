<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\cart;
use App\Models\user;

class CartController extends Controller
{
    
    public function index(Request $req)
    {
        // $user = DB::table('users')
        // ->join('carts', 'users.id', '=', 'carts.users_id')
        // ->where('carts.id',1)
        // ->get();

        $cart = DB::table('carts')
        ->join('products', 'products.id', '=', 'carts.products_id')
        ->join('users', 'users.id', '=', 'carts.users_id')
        ->select('carts.*', 'products.description','products.price', 'users.email','users.name')
        ->get();

        dd($cart);
    }

    
    

}
