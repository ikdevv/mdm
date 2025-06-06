<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'code',
        'name',
        'status',
        'created_by',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
