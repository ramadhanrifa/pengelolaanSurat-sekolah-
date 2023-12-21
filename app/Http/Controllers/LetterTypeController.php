<?php

namespace App\Http\Controllers;

use App\Models\letter_type;
use Illuminate\Http\Request;
use App\Exports\typeExport;
use Excel;


class LetterTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type = letter_type::with('letter')->orderBy('letter_code', 'DESC')->simplePaginate(5);

        return view('surat.tu.klasifikasi.index', compact('type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('surat.tu.klasifikasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_surat'=> 'required',
            'klasifikasi'=> 'required',
        ], [
            'kode_surat'=> 'silahkan isi nama terlebih dahulu',
            'klasifikasi'=> 'silahkan isi  terlebih dahulu',
        ]);

        $amount = letter_type::count()+1;

        $letterCodeWithAmount = $request->kode_surat . '-' . $amount;


        letter_type::create([
            'letter_code' =>$letterCodeWithAmount,
            'name_type' =>$request->klasifikasi,
        ]);

        return redirect()->back()->with('success', 'Berhasi menambahkan klasifikasi surat');
    }

    /**
     * Display the specified resource.
     */
    public function detail($id)
    {
        $letter_type = letter_type::with('letter')->where('id', $id)->simplePaginate(1);
        return view('surat.tu.klasifikasi.detail', compact('letter_type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(letter_type $letter_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, letter_type $letter_type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        letter_type::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'data berhasil dihapus');
    }


    public function export_excel()
    {
        return Excel::download(new typeExport, 'klasifikasi.xlsx');
    }
}
