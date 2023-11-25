<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Listing;
use Illuminate\Http\Request;

class CartController extends Controller
{
    
    // Add to cart
    public function addToCart(Listing $listing) {
        $cart = Cart::find(auth()->user()->id);

        if(str_contains($cart->product_ids, $listing->id)) {
            $arrayOfIds = explode(',', $cart->product_ids);
            $arrayOfQuant = explode(',', $cart->quantities);

            for($i = 0; $i < sizeof($arrayOfIds); $i++) {
                if($arrayOfIds[$i] == $listing->id) {
                    $arrayOfQuant[$i] = $arrayOfQuant[$i] + 1;
                }
            }

            $product_ids = '';
            $quantities = '';
            for($i = 1; $i < sizeof($arrayOfIds); $i++) {
                $product_ids = $product_ids . ',' . $arrayOfIds[$i];
                $quantities = $quantities . ',' . $arrayOfQuant[$i];
            }
        } else {
            $product_ids = $cart->product_ids . ',' . $listing->id;
            $quantities = $cart->quantities . ',1';
        }

        $formFields = [
            'user_id' => auth()->user()->id, 
            'product_ids' => $product_ids, 
            'quantities' => $quantities
        ];

        $cart->update($formFields);

        return back()->with('message', 'Part succesfully added to a cart');
    }

    public function removeFromCart(Listing $listing) {
        $cart = Cart::find(auth()->user()->id);

        $arrayOfIds = explode(',', $cart->product_ids);
        $arrayOfQuant = explode(',', $cart->quantities);


        $index = 0;
        for($i = 0; $i < sizeof($arrayOfIds); $i++) {
            if($arrayOfIds[$i] == $listing->id) {
                if($arrayOfQuant[$i] == 1) {
                    $index = $i;
                } else {
                    $arrayOfQuant[$i] = $arrayOfQuant[$i] - 1;
                }
            }
        }

        $product_ids = '';
        $quantities = '';
        for($i = 1; $i < sizeof($arrayOfIds); $i++) {
            if($i == $index){ 
                continue;
            }
            $product_ids = $product_ids . ',' . $arrayOfIds[$i];
            $quantities = $quantities . ',' . $arrayOfQuant[$i];
            }

        $formFields = [
            'user_id' => auth()->user()->id, 
            'product_ids' => $product_ids, 
            'quantities' => $quantities
        ];

        $cart->update($formFields);

        return back()->with('message', 'Part succesfully removed from cart');
    }

    public function show() {
        return view('cart.show', ['cart' => Cart::find(auth()->user()->id)]);
    }
}
