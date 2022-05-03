<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showForgetPasswordForm()
    {
        return view('auth.forgotPassword');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('email.forgotPassword', ['token' => $token],
            function($message) use($request) {
                $message->to($request->email);
                $message->subject('Reset password');
            }
        );

        return back()->with('message', 'We\'ve emailed you a link to recover your password!');
    }
}
