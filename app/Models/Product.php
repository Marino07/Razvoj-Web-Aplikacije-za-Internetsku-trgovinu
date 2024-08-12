<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'discount_price',
        'quantity',
        'category_id',
        'image',
    ];
    use HasFactory;
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
