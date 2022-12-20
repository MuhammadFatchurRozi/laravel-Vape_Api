<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\product;

use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resource_product = ProductResource::collection(product::all());
        return response()->json([
            'status' => 'success ',
            'message' => 'showing all product',
            'data' => $resource_product
        ], Response::HTTP_OK);
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
            'product_name' => 'required|string',
            'quantity' => 'required|integer|digits-between:1,3',
            'price' => 'required|integer|digits-between:4,7',
            'description' => 'required|string|max:255',
            'categories_id' => 'required|numeric|digits-between:1,3',
            'cart_id' => 'required|numeric|digits-between:1,3',
            'vendor_id' => 'required|numeric|digits-between:1,3'
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => "failed",
                "message" => "failed to create new product",
                "data" => $validator->errors()
            ],Response::HTTP_NOT_ACCEPTABLE);
        }

        $resource_product = new ProductResource(product::create($request->all()));
        return response()->json([
            'status' => 'success',
            'message' => 'product created',
            'data' => $resource_product
        ], Response::HTTP_CREATED);
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
            $products = new ProductResource(product::findorFail($id));
            return response()->json([
                'status' => 'success ',
                'message' => 'showing product',
                'data' => $products
            ], Response::HTTP_OK);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'failed ',
                'message' => 'product not found',
                'data'=> $e->getMessage()
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
            'product_name' => 'required|string',
            'quantity' => 'required|integer|digits-between:1,3',
            'price' => 'required|integer|digits-between:4,7',
            'description' => 'required|string|max:255',
            'categories_id' => 'required|numeric|digits-between:1,3',
            'cart_id' => 'required|numeric|digits-between:1,3',
            'vendor_id' => 'required|numeric|digits-between:1,3'
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => "failed",
                "message" => "failed to update product",
                "data" => $validator->errors()
            ],Response::HTTP_NOT_ACCEPTABLE);
        }

        try{
            $products = new ProductResource(product::findorFail($id));
            $products->update($request->all());
            return response()->json([
                'status' => 'success ',
                'message' => 'product updated',
                'data' => $products
            ], Response::HTTP_OK);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'failed ',
                'message' => 'product not found',
                'data'=> $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
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
            $products = new ProductResource(product::findorFail($id));
            $products->delete();
            return response()->json([
                'status' => 'success ',
                'message' => 'product deleted',
                'data' => $products
            ], Response::HTTP_OK);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'failed ',
                'message' => 'product not found',
                'data'=> $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
