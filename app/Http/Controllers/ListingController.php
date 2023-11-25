<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    public function authorizedUser() {
        if(auth()->user()->permission < 1) {
            abort(403, 'Unauthorized acces');
        }
    }

    // Show all listings
    public function index(){
        return view('listings.index', [
            'heading' => 'Latest Listings', 
            'listings' => Listing::filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    // Show single listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Show Create Form
    public function create() {
        $this->authorizedUser();

        return view('listings.create');
    }

    // Store listing data
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => 'required',
            'location' => 'required', 
            'tags' => 'required', 
            'description' => 'required', 
            'quantity' => ['required', 'integer'], 
            'price' => ['required', 'decimal:0,2']
        ]);

        if($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created succesfully!');
    }

    // Show Edit Form   
    public function edit(Listing $listing) {
        return view('listings.edit', ['listing' => $listing]);
    }

    // Update Listing Data
    public function update(Request $request, Listing $listing) {
        $formFields = $request->validate([
            'name' => 'required',
            'location' => 'required', 
            'tags' => 'required', 
            'description' => 'required', 
            'quantity' => ['required', 'integer'], 
            'price' => ['required', 'decimal:0,2']
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', ['public']);
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated succesfully');
    }

    // Delete Listing
    public function destroy(Listing $listing) {
        $listing->delete();

        return redirect('/')->with('message', 'Listing deleted succesfully.');
    }

    // Manage Listings
    public function manage() {
        $this->authorizedUser();

        $user = auth()->user();
        return view('listings.manage', ['listings' => Listing::all()]);
    }
}
