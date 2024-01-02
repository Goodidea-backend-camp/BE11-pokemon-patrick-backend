<?php

namespace App\Http\Controllers;

use App\Models\User;

class VerificationController extends Controller
{

    public function verify($code)
    {
        $user = User::where('verification_code', $code)->first();

        if (!$user) {
            return redirect('/api/login')->with('error', 'Invalid verification code.');
        }

        $user->update(['verification_code' => null, 'email_verified_at' => now()]);

        return redirect('/api/login')->with('success', 'Email verification successful. You can now log in.');
    }
}