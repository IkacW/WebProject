<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
    public function resetPassword(){
        return view('passwordReset.resetForm');
    }

    public function mailForm(Request $request) {
        $formFields = $request->validate([
            'email' => 'required|email|exists:user'
        ]);

        $token = Str::random(64);

        if($p_request = DB::table('password_resets')->where('email', $request->email)) {
            $p_request->delete();
        }

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);

        Mail::send('emails.password-reset', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset password');
        });

        return redirect('/')->with('message', 'Password reset form is sent to your mail.');
    }

    public function passwordChange($token) {
        return view('passwordReset.new-password', compact('token'));
    }

    public function passwordChangePost(Request $request) {
        $formFields = $request->validate([
            'email' => 'required|email|exists:password_resets',
            'password' => 'required|min:6|confirmed', 
            'password_confirmation' => 'required'
        ]);

        $query = DB::select('select * from password_resets where email = ?', [ $request->email ]);

        if($query[0]->token != $request->token) {
            return redirect('/')->with('message', 'Error! Fill password reset form again.');
        }

        DB::table('password_resets')->where('email', $request->email)->delete();

        User::where('email', $request->email)->update(['password' => bcrypt($request->password)]);

        return redirect('/')->with('message', 'Password updated successfullly.');
    }
}
