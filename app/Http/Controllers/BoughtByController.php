<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Listing;
use App\Models\BoughtBy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoughtByController extends Controller
{
    public function order(Request $request) {
        $formFields = $request->validate([
            'adress' => 'required'
        ]);

        $cart = Cart::find(auth()->user()->id);

        $product_ids = explode(',', $cart->product_ids);
        $quantities = explode(',', $cart->quantities);

        for($i = 1; $i < sizeof($product_ids); $i++) {
            $listing = Listing::find($product_ids[$i]);
            if($listing->quantity < $quantities[$i]) {
                return back()->with('message','The ' . $listing->name . ' is not available at that capacity. There is only ' . $listing->quantity . ' remaining');
            }
        }

        $formFields['user_id'] = auth()->user()->id;
        for($i = 1; $i < sizeof($product_ids); $i++) {
            $formFields['listing_id'] = $product_ids[$i];
            $formFields['quantity'] = $quantities[$i];

            DB::beginTransaction();
            try {
                $listing = Listing::find($product_ids[$i])->lockForUpdate()->first(); 
                $quantity = $listing->quantity -  $quantities[$i];
                $listing->update(['quantity' => $quantity]);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
        
                throw $e;
            }

            BoughtBy::create($formFields);
        }
        
        $formFields = array();

        $formFields['user_id'] = auth()->user()->id;
        $formFields['product_ids'] = null;
        $formFields['quantities'] = null;
        
        $cart->update($formFields);

        return redirect('/')->with('message', 'You have succesfully places the order.');
    }
}
