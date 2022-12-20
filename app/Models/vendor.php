<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\product;

class vendor extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $primaryKey = 'id';

    public function product()
    {
        return $this->hasMany(product::class);
    }
}
