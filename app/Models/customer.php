<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\cart;
use App\Http\Resources\CartResource;

class customer extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function cart()
    {
        return $this->belongsTo(cart::class);
    }
}
