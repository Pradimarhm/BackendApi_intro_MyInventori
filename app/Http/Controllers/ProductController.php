<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use Exception;

class ProductController extends Controller
{
    function index() {
        // return response()->json('hello world');
        return product::all();
    }

    function save(Request $request){
        try {
            $request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
            ]);

            $product = new product();
            $product->name = $request->get('name');
            $product->description = $request->get('description');
            $product->save();

            return response()->json([
                'message'=>'Berhasil Tambah Product'
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'message'=>$e
            ], 500);
        }
    }

    function delete($id){
        try {
            $product = product::findOrFail($id);
            $product->delete();
            return response()->json([
                'message'=>'Berhasil Hapus Product'
            ], 202);

        } catch (Exception $e) {
            return response()->json([
                'message'=>$e
            ], 500);
        }
    }

    function store() {

    }


}
