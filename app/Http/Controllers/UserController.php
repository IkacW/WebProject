<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function unauthorizedUser() {
        if(auth()->user()->permission != 2) {
            abort(403, 'Unauthorized acces');
        }
    }

    public function index() {
        $this->unauthorizedUser();

        return view('users.menu', ['users' => User::all()]);
    }

    public function edit(User $user) {
        $this->unauthorizedUser();

        return view('users.edit', ['user' => $user]);
    }

    public function authorizedUser() {
        if(auth()->user()->permission < 1) {
            return false;
        }
        return true;
    }

    public function create() {
        return view('users.register');
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'], 
            'email' => ['required', 'email', Rule::unique('user', 'email')], 
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        $formFields['password'] = bcrypt($formFields['password']);
        $formFields['permission'] = 0;

        $user = User::create($formFields);
        Cart::create([
            'user_id' => $formFields[$user->id]
        ]);

        auth()->login($user);
        
        return redirect('/')->with('message', 'User created and logged in.');
    }

    public function update(Request $request, User $user) {
        $this->unauthorizedUser();

        $formFields = $request->validate([
            'name' => ['required', 'min:3'], 
            'email' => ['required', 'email'], 
            'permission' => ['required', 'integer','min:0',  'max:2']
        ]);

        $user->update($formFields);

        return redirect('/')->with('message', 'User has been succesfully updated');
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out succesfully!');
    }

    public function login() {
        return view('users.login');
    }

    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'    
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }
}
