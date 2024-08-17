<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'payment_method',
        'status',
        'total_amount',
    ];

    public function user(){
        $this->belongsTo(User::class);
    }
}
