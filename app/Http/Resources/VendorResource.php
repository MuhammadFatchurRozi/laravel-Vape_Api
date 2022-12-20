<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ([
            'id' => $this->id,
            'vendor_name' => $this->vendor_name, // This is the vendor name
            'vendor_email' => $this->vendor_email, // This is the vendor email
            'vendor_phone' => $this->vendor_phone, // This is the vendor phone
            'vendor_address' => $this->vendor_address, // This is the vendor address
            'vendor_city' => $this->vendor_city, // This is the vendor city
            'vendor_province' => $this->vendor_province, // This is the vendor province
            'vendor_postal_code' => $this->vendor_postal_code, // This is the vendor postal code
            'vendor_country' => $this->vendor_country, // This is the vendor country
            'vendor_description' => $this->vendor_description, // This is the vendor description
            'vendor_product' => ProductResource::collection($this->product), // This is the vendor product
            // 'product_name' => $this->product->pluck('product_name'), // This is a different way to get the product name
        ]);
    }
}
