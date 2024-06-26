<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('Admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        return redirect('/login');
    }
}
