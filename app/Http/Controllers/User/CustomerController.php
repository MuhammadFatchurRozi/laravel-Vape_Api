<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\customer;
use App\Models\cart;
use App\Http\Resources\CustomerResource;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = CustomerResource::collection(customer::all());
        try{
            return response()->json([
                'status' => 'success',
                'message' => 'showing all customers',
                'data' => $customers
            ], Response::HTTP_OK);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to show all customers',
                'data' => $e->getMessage()
            ], Response::HTTP_NOT_ACCEPTABLE);
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
        $validator = Validate::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'profile_photo_path' => 'required|string',
            'birth_date' => 'required|date',
            'address' => 'required|string',
            'phone' => 'required|numeric|digits:12',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to create new customer',
                'data' => $validator->errors()
            ], Response::HTTP_NOT_ACCEPTABLE);
        }
        else{
            $products = new CustomerResource(customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'profile_photo_path' => $request->profile_photo_path,
                'birth_date' => $request->birth_date,
                'address' => $request->address,
                'phone' => $request->phone,
            ]));
        }

        try{
            return response()->json([
                'status' => 'success',
                'message' => 'customer created',
                'data' => $products
            ], Response::HTTP_Created);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to create new customer',
                'data' => $e->getMessage()
            ], Response::HTTP_NOT_ACCEPTABLE);
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
        $customer = new CustomerResource(customer::findorFail($id));
        try{
            return response()->json([
                'status' => 'success',
                'message' => 'showing customer',
                'data' => $customer
            ], Response::HTTP_OK);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to show customer',
                'data' => $e->getMessage()
            ], Response::HTTP_NOT_ACCEPTABLE);
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
        $validator = Validate::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'profile_photo_path' => 'required|string',
            'birth_date' => 'required|date',
            'address' => 'required|string',
            'phone' => 'required|numeric|digits:12',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to create new customer',
                'data' => $validator->errors()
            ], Response::HTTP_NOT_ACCEPTABLE);
        }
        else{
            $products = new CustomerResource(customer::update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'profile_photo_path' => $request->profile_photo_path,
                'birth_date' => $request->birth_date,
                'address' => $request->address,
                'phone' => $request->phone,
            ]));
        }

        try{
            return response()->json([
                'status' => 'success',
                'message' => 'customer updated',
                'data' => $products
            ], Response::HTTP_UPDATED);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to update customer',
                'data' => $e->getMessage()
            ], Response::HTTP_NOT_ACCEPTABLE);
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
        $customer = customer::findorFail($id);
        $customer->delete();
        try{
            return response()->json([
                'status' => 'success',
                'message' => 'customer deleted',
                'data' => $customer
            ], Response::HTTP_OK);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to delete customer',
                'data' => $e->getMessage()
            ], Response::HTTP_NOT_ACCEPTABLE);
        }
    }
}
