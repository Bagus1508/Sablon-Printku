<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function indexLogin() {
        return view('pages.auth.login.index');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout(); // Pastikan menggunakan guard 'web'
    
        return redirect('/login'); // Redirect ke halaman login
    }
}
