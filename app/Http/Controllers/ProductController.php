<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use Exception;
// use League\Config\Exception\ValidationException;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    function index(Request $request) {
        // return response()->json('hello world');
        // $key = $request->header('X-API-KEY');
        $products = product::all();
        return response()->json($products);
    }

    function create(Request $request){
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

        }catch (ValidationException $e){
            return response()->json([
                'error'=> $e->errors(),
                'message'=> 'input tidak valid'
            ],  422);
        } catch (Exception $e) {
            return response()->json([
                'message'=>$e->getMessage()
            ], 500);
        }
    }

    function edit($id) {
        // return response()->json('hello world');

        try {
            $product = product::findOrFail($id);
            return response()->json([
                'status' => 200,
                'product' => $product
            ], 200);
            // return response()->json([
            //     'message'=>'Berhasil Hapus Product'
            // ], 202);

        } catch(ValidationException $e){
            return response()->json([
                'error'=> $e->errors(),
                'message'=> 'input tidak valid'
            ],  422);
        } catch (Exception $e) {
            return response()->json([
                'message'=>$e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            // 'image'=>'nullable'
        ]);
        try{
            $product = Product::findOrFail($id);
            $product->update($request->only(['name', 'description']));
            // $product->fill($request->post())->update();
            // if($request->hasFile('image')){
            // // remove old image
            //     if($product->image){
            //         $exists = Storage::disk('public')->exists("product/image/{$product->image}");
            //         if($exists){
            //             Storage::disk('public')->delete("product/image/{$product->image}");
            //         }
            //     }
            //     $imageName = Str::random().'.'.$request->image->getClientOriginalExtension;
            //     Storage::disk('public')->putFileAs('product/image', $request->image,$image);

            //     $product->image = $imageName;
            //     $product->save();
            // }
            return response()->json([
                'message'=>'Product Updated Successfully!!'
            ]);
        }catch(ValidationException $e){
            return response()->json([
                'error'=> $e->errors(),
                'message'=> 'input tidak valid'
            ],  422);
        } catch (Exception $e) {
            return response()->json([
                'message'=>$e->getMessage()
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

        }catch(ValidationException $e){
            return response()->json([
                'error'=> $e->errors(),
                'message'=> 'input tidak valid'
            ],  422);
        } catch (Exception $e) {
            return response()->json([
                'message'=>$e
            ], 500);
        }
    }

    function store() {

    }


}
