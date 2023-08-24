<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = [
        'name', 'description',
    ];

    public function attributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class);
    }
}
