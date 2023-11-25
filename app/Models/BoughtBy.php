<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoughtBy extends Model
{
    use HasFactory;

    protected $table = 'boughtby';
    protected $fillable = ['id', 'user_id', 'listing_id', 'quantity', 'adress'];

    public function product() {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    public function boughtBy() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
