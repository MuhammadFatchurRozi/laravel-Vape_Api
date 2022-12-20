<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\product_category;
use App\Http\Resources\Product_CategoryResource;

class Product_CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_category = Product_CategoryResource::collection(product_category::all());
        return response()->json([
            'status' => 'success ',
            'message' => 'showing all product_category',
            'data' => $product_category
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
            'name' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => "failed",
                "message" => "failed to create new product_category",
                "data" => $validator->errors()
            ],Response::HTTP_NOT_ACCEPTABLE);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'created new product_category',
            'data' => product_category::create($request->all())
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
            $product_category = product_category::findOrFail($id);
            return response()->json([
                'status' => 'success ',
                'message' => 'showing product_category',
                'data' => $product_category
            ], Response::HTTP_OK);
        }
        catch(\Exeception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to show product_category',
                'data' => $e->getMessage()
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
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => "failed",
                "message" => "failed to update product_category",
                "data" => $validator->errors()
            ],Response::HTTP_NOT_ACCEPTABLE);
        }

        $product_category = product_category::findOrFail($id);
        $product_category->update($request->all());
        return response()->json([
            'status' => 'success ',
            'message' => 'updated product_category',
            'data' => $product_category
        ], Response::HTTP_OK);
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
            $product_category = product_category::findOrFail($id);
            $product_category->delete();
            return response()->json([
                'status' => 'success ',
                'message' => 'deleted product_category',
                'data' => $product_category
            ], Response::HTTP_OK);
        }
        catch(\Exeception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to delete product_category',
                'data' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
