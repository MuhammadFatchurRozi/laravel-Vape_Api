<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\{
    product_category, 
    product_img, 
    cart, 
    vendor
};

class product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function category()
    {
        return $this->belongsTo(product_category::class, 'categories_id');
    }

    public function image()
    {
        return $this->hasMnay(product_img::class);
    }

    public function cart()
    {
        return $this->belongsTo(cart::class);
    }

    public function vendor()
    {
        return $this->belongsTo(vendor::class);
    }
}
