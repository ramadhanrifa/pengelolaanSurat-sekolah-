<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Letter;
use App\Models\letter_type;

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
        $surat = Letter::with('user')->count();

        return view('user.guru.dashboard', compact('surat'));
    }
}
