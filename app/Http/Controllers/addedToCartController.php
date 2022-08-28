<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\product;
use App\Models\addedtocart;


class addedToCartController extends Controller
{
    //
    public function deleteCart(Request $request)
    {   
        $product = addedtocart::find($request->id);
        $result = $product->delete();
    }


    public function addToCart(Request $request, $product)
    {
        $addedCart = addedtocart::updateOrCreate([
            'product_id' => $product,
            'user_id' => auth()->id(),
            'qty' => 1 ,
        ]);
        return response($addedCart);
    }

    public function getCarts()
    {
        $addedCarts = addedtocart::query()
            ->with('product')
            ->where('user_id', auth()->id())
            ->get();
            
        return $addedCarts;

        // $addedCarts = addedtocart::all();
        // return $addedCarts;
    }

    public function changeQty (Request $request)
    {
        if($request->operation == 'minus') {
            $data = DB::table('addedtocarts')
            ->where('id', '=', $request->id);

            $data->decrement('qty');
        } else if($request->operation == 'add') {
            $data = DB::table('addedtocarts')
            ->where('id', '=', $request->id);

            $data->increment('qty');
        } 
        
    }
    // public function decrementQty (Request $request)
    // {
    //     $data = DB::table('addedtocarts')
    //         ->where('id', '=', $request->id);

    //     $data->decrement('qty');
    // }

    public function allAddedCart()
    {

        $datas = DB::table('addedtocarts')
        ->join('products', 'addedtocarts.product_id', '=', 'products.id')
        ->join('users', 'addedtocarts.user_id', '=', 'users.id')
        ->select('addedtocarts.*', 'products.name', 'products.file_path', 'users.name', 'users.email')
        ->get();

        return response($datas);

    }
}
