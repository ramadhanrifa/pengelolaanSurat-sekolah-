<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Letter;
use App\Models\letter_type;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    public function dashboard ()
    {
        $tu = User::where('role', 'staff')->count();
        $guru = User::where('role', 'guru')->count();
        $klasifikasi = letter_type::count();
        $surat = Letter::count();

        return view('user.tu.dashboard', compact('tu', 'guru', 'klasifikasi', 'surat'));
    }
    public function dashboardGuru()
    {
        // $user = User::where(Auth::user()->name);
        $surat = Letter::where('recipients', 'LIKE', '%'.Auth::user()->name.'%')->count();

        return view('user.guru.dashboard', compact('surat'));
    }
}
