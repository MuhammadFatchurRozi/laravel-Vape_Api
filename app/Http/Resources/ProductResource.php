<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    // define properties
    public $status;
    public $message;
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
            'name' => $this->product_name,
            'description' => $this->description,
            'price' => $this->price,
            'category' => $this->category->category_name,
            'stok' => $this->quantity,
            
            
            // 'stock' => $this->stock,
            // 'discount' => $this->discount,
            // 'totalPrice' => round((1 - ($this->discount / 100)) * $this->price, 2),
            // 'rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star') / $this->reviews->count(), 2) : 'No rating yet',
            // 'href' => [
            //     'reviews' => route('reviews.index', $this->id)
            // ]
        ]);
    }
}
