<?php

namespace App\Http\Controllers;

use App\Models\BoughtBy;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function authorizedUser() {
        if(auth()->user()->permission < 1) {
            abort(403, 'Unauthorized acces');
        }
    }

    public function index() {
        $this->authorizedUser();   
        return view('orders.index', [
            'orders' => BoughtBy::join('listing', 'boughtby.listing_id', '=', 'listing.id')
            ->join('user', 'boughtby.user_id', '=', 'user.id')
            ->select('listing.name', 'listing.image', 'listing.price', 'boughtby.*')
            ->orderBy('created_at', 'desc')
            ->get()
        ]);
    }
}
