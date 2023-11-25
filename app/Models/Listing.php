<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'listing';
    protected $fillable = ['name', 'location', 'tags', 'description', 'image', 'quantity', 'price'];

    public function scopeFilter($query, array $filters) {
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%')
                  ->orWhere('description', 'like', '%' . request('search') . '%')                
                  ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    public function boughtby() {
        return $this->hasMany(BoughtBy::class, 'listing_id');
    }
}
