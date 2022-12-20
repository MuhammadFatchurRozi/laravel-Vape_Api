<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\cart;
use App\Http\Resources\CartResource;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = CartResource::collection(cart::all());
        return response()->json([
            'status' => 'success ',
            'message' => 'showing all cart',
            'data' => $cart
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
            'product_id' => 'required|numeric|digits_between:1,3',
            'quantity' => 'required|numeric|digits_between:1,3',
            'user_id' => 'required|numeric|digits_between:1,3',
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => "failed",
                "message" => "failed to create new cart",
                "data" => $validator->errors()
            ],Response::HTTP_NOT_ACCEPTABLE);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'cart created',
            'data' => new CartResource(cart::create($request->all()))
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
            $cart = new CartResource(cart::findOrFail($id));
            return response()->json([
                'status' => 'success',
                'message' => 'showing cart',
                'data' => $cart
            ], Response::HTTP_OK);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'cart not found',
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
            'quantity' => 'required|integer|digits_between:1,3',
            'user_id' => 'required|numeric|digits_between:1,3',
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => "failed",
                "message" => "failed to update cart",
                "data" => $validator->errors()
            ],Response::HTTP_NOT_ACCEPTABLE);
        }

        try{
            $cart = new CartResource(cart::findOrFail($id));
            $cart->update($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'cart updated',
                'data' => $cart
            ], Response::HTTP_OK);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'cart not found',
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
            $cart = new CartResource(cart::findOrFail($id));
            $cart->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'cart deleted',
                'data' => $cart
            ], Response::HTTP_OK);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'cart not found',
            ], Response::HTTP_NOT_FOUND);
        }
    }  
}
