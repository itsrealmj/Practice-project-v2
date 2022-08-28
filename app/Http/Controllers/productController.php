<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\product;


class productController extends Controller
{
    function getProducts(Request $request)
    {
        $data = product::where('name', 'LIKE','%'.$request->search.'%')->paginate($request->itemPerPage);
        return response()->json($data);
        // return $data;
    }

    function manageProducts() 
    {
        return product::all();
    }
    
    function addProduct(Request $request)
    {   
        // $imageName = $request->file('image')->getClientOriginalName();

        $product = new product;
        $product->name = $request->name;
        // $product->file_path = $request->file('image')->storeAs('public/images', $imageName);
        $product->price = $request->price;
        $product->description = $request->description;
        $result = $product->save();

        if($result) {
            return redirect('/add');
        }else {
            return 'Unable to save data';
        }
    }
    
    function deleteProduct(Request $req)
    {
        $id = $req->id;
        $product = product::find($id);
        $result = $product->delete();

        if($result) {
            return redirect('/');
        }
    }
    
    function updateProduct(Request $req)
    {
        $id = $req->id;
        $data = product::find($id);
        
        $imageName = $req->file('image')->getClientOriginalName();

        $data->name = $req->name;
        $data->price = $req->price;
        $data->description = $req->description;
        $product->file_path = $req->file('image')->storeAs('public/images', $imageName);

        $data->save();
        return redirect('/productManagement');
    }


}
