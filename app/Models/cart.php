<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\customer;
use App\Models\product;

class cart extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $hidden = [
        'created_at', 
        'updated_at',
    ];

    public function customer()
    {
        return $this->hasMany(customer::class);
    }

    public function product()
    {
        return $this->hasMany(product::class);
    }
}
