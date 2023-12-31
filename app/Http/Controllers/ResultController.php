<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Letter;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $letters = Letter::orderBy('letter_type_id', 'DESC')->with('letter_type', 'result')->simplePaginate(5);
        // dd($letters);
        $result = Result::all();

        return view('surat.guru.index', compact('letters', 'result'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        // $user = Usaer::where('role', '=', 'guru')->simplePaginate(5);
        $letters = Letter::find($id);
        return view('surat.guru.hasil', compact('letters'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'letter_id' => 'required',
            'notes' => 'required',
            'presence_recipients' => 'required',
        ], [
            'letter_id.required'=> 'harap Diisi',
            'notes.required'=> 'harap Diisi',
            'presence_recipients.required'=> 'harap Diisi',
        ]);

        $presence_recipients = json_encode($request->input('presence_recipients'));

        Result::create([
            'letter_id'=>$request->letter_id,
            'presence_recipients'=>$presence_recipients,
            'notes'=>$request->notes,

        ]);
        return redirect()->route('guru.index')->with('success', 'berhasil menambahkan hasil');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $letter = Letter::with('user')->find($id);

        return view('surat.guru.lihat', compact('letter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        //
    }
}
