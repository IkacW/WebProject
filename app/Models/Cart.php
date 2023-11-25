<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'cart';
    protected $primaryKey = 'user_id';

    protected $fillable = ['user_id', 'product_ids', 'quantities'];
}
