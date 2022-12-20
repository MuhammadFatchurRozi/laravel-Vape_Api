<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\product;

class Product_ImgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $product = product::all();
            return response()->json([
                'status' => 'success ',
                'message' => 'showing all product',
                'data' => $product
            ], Response::HTTP_OK);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to show all product',
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|numeric|digits_between:1,3',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024|dimensions:min_width=500,min_height=500',
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => "failed",
                "message" => "failed to create new product",
                "data" => $validator->errors()
            ],Response::HTTP_NOT_ACCEPTABLE);
        }

        try{
            $product = new product;
            $product->product_id = $request->product_id;
            $product->image = $request->image;
            $product->save();

            return response()->json([
                "status" => "success",
                "message" => "successfully created new product",
                "data" => $product
            ],Response::HTTP_CREATED);
        }
        catch(\Exception $e){
            return response()->json([
                "status" => "failed",
                "message" => "failed to create new product",
            ],Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $product = product::find($id);
            return response()->json([
                'status' => 'success ',
                'message' => 'showing product',
                'data' => $product
            ], Response::HTTP_OK);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to show product',
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|numeric|digits_between:1,3',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024|dimensions:min_width=500,min_height=500',
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => "failed",
                "message" => "failed to update product",
                "data" => $validator->errors()
            ],Response::HTTP_NOT_ACCEPTABLE);
        }

        try{
            $product = product::find($id);
            $product->product_id = $request->product_id;
            $product->image = $request->image;
            $product->save();

            return response()->json([
                "status" => "success",
                "message" => "successfully updated product",
                "data" => $product
            ],Response::HTTP_CREATED);
        }
        catch(\Exception $e){
            return response()->json([
                "status" => "failed",
                "message" => "failed to update product",
            ],Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $product = product::find($id);
            $product->delete();

            return response()->json([
                "status" => "success",
                "message" => "successfully deleted product",
                "data" => $product
            ],Response::HTTP_OK);
        }
        catch(\Exception $e){
            return response()->json([
                "status" => "failed",
                "message" => "failed to delete product",
            ],Response::HTTP_NOT_FOUND);
        }
    }
}
