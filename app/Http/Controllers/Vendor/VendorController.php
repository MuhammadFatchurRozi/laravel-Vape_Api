<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\vendor;
use App\Http\Resources\VendorResource;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'showing all vendors',
            'data' => VendorResource::collection(vendor::all())
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
        $validator = Validate::make($request::all(), [
            'vendor_name' => 'required|string',
            'vendor_email' => 'required|email',
            'vendor_phone' => 'required|numeric|digits:12',
            'vendor_address' => 'required|string',
            'vendor_city' => 'required|string',
            'vendor_province' => 'required|string',
            'vendor_postal_code' => 'required|numeric|digits:5',
            'vendor_country' => 'required|string',
            'vendor_description' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to create new vendor',
                'data' => $validator->errors()
            ], Response::HTTP_NOT_ACCEPTABLE);
        }

        try{
            return response()->json([
                'status' => 'success',
                'message' => 'vendor created',
                'data' => new VendorResource(vendor::create($request->all()))
            ], Response::HTTP_CREATED);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to create new vendor',
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
        try{
            return response()->json([
                'status' => 'success',
                'message' => 'showing vendor',
                'data' => new VendorResource(vendor::findorFail($id))
            ], Response::HTTP_OK);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to show vendor',
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
        $validator = Validate::make($request->all(),[
            'vendor_name' => 'required|string',
            'vendor_email' => 'required|email',
            'vendor_phone' => 'required|numeric|digits:12',
            'vendor_address' => 'required|string',
            'vendor_city' => 'required|string',
            'vendor_province' => 'required|string',
            'vendor_postal_code' => 'required|numeric|digits:5',
            'vendor_country' => 'required|string',
            'vendor_description' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to update vendor',
                'data' => $validator->errors()
            ], Response::HTTP_NOT_ACCEPTABLE);
        }

        try{
            $vendors = new VendorResource(vendor::findorFail($id));
            $vendors->update($request->all()); 
            return response()->json([
                'status' => 'success',
                'message' => 'vendor updated',
                'data' => $vendors
            ], Response::HTTP_OK);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to update vendor',
                'data' => $e->getMessage()
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
            $vendors = new VendorResource(vendor::findorFail($id));
            $vendors->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'vendor deleted',
                'data' => $vendors
            ], Response::HTTP_OK);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to delete vendor',
                'data' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
