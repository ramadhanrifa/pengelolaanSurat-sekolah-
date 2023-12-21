<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('nama')) {
            $searchName = $request->input('nama');
            $users = User::where('name', 'LIKE', '%'. $searchName. '%')->simplepaginate(10);
        }else {
            $users = User::where('role', '=', 'staff')->orderBy('name', 'ASC')->simplePaginate(10);
        }
        return view('user.tu.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.tu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|min:3',
        ],[
            'name.required'=> 'nama user wajib diisi',
            'name.min'=> 'nama user minimal 3 huruf',
            // 'email.email' => 'penulisan email haruf valid contoh @gmail',
            'role.required'=> 'bagian role wajib diisi',

        ]);
        $password = substr(str_replace(' ', '', $request->name), 0, 3) . substr(str_replace(' ', '', $request->email), 0, 3);

        User::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'role' =>Auth::user()->role,
            'password' => Hash::make($password),
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data user');
    }


    public function edit($id)
    {
        $user =User::find($id);

        return view('user.tu.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
        ]);

        User::where('id', $id)->update([
            'name' =>$request->name,
            'email' =>$request->email,
        ]);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        User::where('id', $id)->update($data);

        if(Auth::user()->role == 'staff'){
            return redirect()->route('user.tu.index')->with('success', 'Berhasil mengubah user!');
        } else {
            return redirect()->route('user.guru.index')->with('success', 'Berhasil mengubah user!');
        }
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'user berhasil dihapus!');
    }


    // bagian Guru

    public function indexGuru()
    {

        $users = User::where('role', 'guru')->orderBy('name', 'ASC')->simplePaginate(10);
        return view('user.guru.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createGuru()
    {
        return view('user.guru.create');
    }

    public function storeGuru(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|min:3',
        ],[
            'name.required'=> 'nama user wajib diisi',
            'name.min'=> 'nama user minimal 3 huruf',
            'role.required'=> 'bagian role wajib diisi',

        ]);
        $password = substr(str_replace(' ', '', $request->name), 0, 3) . substr(str_replace(' ', '', $request->email), 0, 3);

        User::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'role' =>Auth::user()->role,
            'password' => Hash::make($password),
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data user');
    }

    /**
     * Store a newly created resource in storage.
     */



    public function editGuru($id)
    {
        $user =User::find($id);

        return view('user.guru.edit', compact('user'));
    }

    public function updateGuru(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
        ]);

        User::where('id', $id)->update([
            'name' =>$request->name,
            'email' =>$request->email,
        ]);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        User::where('id', $id)->update($data);

        return redirect()->route('user.guru.index')->with('success', 'Berhasil mengubah user!');
    }

    public function destroyGuru($id)
    {
        User::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'user berhasil dihapus!');
    }

// bagian login

    public function loginAuth(request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required'=> 'masukan email anda',
            'password.required'=> 'masukan password anda',
        ]);

        $user = $request->only(['email', 'password']);
        if(Auth::attempt($user)) {
            if(Auth::user()->role == 'staff'){
                return redirect()->route('user.tu.dashboard.page')->with('success', 'Selamat Datang');

            } else {
                return redirect()->route('user.guru.dashboard.page')->with('success', 'Selamat Datang');
            }
        } else {
            return redirect()->back()->with('failed', 'password atau email anda salah silahkan coba kembali');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Anda telah logout');
    }


}
