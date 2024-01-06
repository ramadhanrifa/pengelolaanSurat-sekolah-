<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\letter_type;
use App\Models\User;
use App\Models\Result;
use Illuminate\Http\Request;
use PDF;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index()
        {

            $letters = Letter::orderBy('letter_type_id', 'DESC')->with('letter_type', 'user', 'result')->simplePaginate(5);
            $result = Result::get();
            // harus gunain with dengan isi public function yang kita buat

            // foreach ($letters as $jumlah){
            //     $jumlah = Letter::first()->count();
            // }

            return view('surat.tu.data.index', compact('letters', 'result'));
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $letters = letter_type::all();
        $user = User::where('role', '=', 'guru')->simplePaginate(5);

        return view('surat.tu.data.create', compact('letters', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'letter_type_id' => 'required',
            'letter_perihal' => 'required',
            'recipients' => 'required',
            'attachment' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required',
            'notulis' => 'required',
        ], [
            'letter_type_id.required' => 'Silahkan diisi terlebih dahulu',
            'letter_perihal.required' => 'Silahkan diisi terlebih dahulu',
            'recipients.required' => 'Silahkan diisi terlebih dahulu',
            'content.required' => 'Silahkan diisi terlebih dahulu',
            'notulis.required' => 'Silahkan diisi terlebih dahulu',
        ]);
        // cara simpel
        $data = $request->all();

        if ($request->hasFile('attachment')) {
            $imagePath = $request->file('attachment')->store('public/images');
            $imageName = basename($imagePath);
            $data['attachment'] = $imageName; // Set the attachment in the $data array
        }

        $letter = Letter::Create($data);

        $id = $this->create($data)->id;

        Result::create([
            'letter_id' => $letter->id,
            'notes'=> null,
            'presence_recipients'=> null,
        ]);

        // beda lagi ini
        // $arrayDistinct = array_count_values($request->recipients);

        // $arrayAssocResepients = [];

        // foreach ($arrayDistinct as $id => $name) {
        //     $recepients = User::where('id', $id)->first();

        //     $name = $recepients['name'];

        //     $arrayitem = [
        //         'id'=> $id,
        //         'name' => $name,
        //     ];

        //     array_push($arrayAssocResepients, $arrayitem);

        // }

        // $amount = Letter::count()+1;

        // $years = date('y');

        // $letter_typeFiltered = $request->letter_type_id . '/' . $amount . '/' . 'SMK Wikrama/XI' . $years;

        // $proses = Letter::create([
        //     'letter_type_id' => $letter_typeFiltered,
        //     'letter_perihal' => $request->letter_perihal,
        //     'recipients' =>$request->recipients,
        //     'content' => $request->content,
        //     'attachment' => $request->lampiran,
        //     'notulis' => $request->notulis
        // ]);

            return redirect()->back()->with('created', 'berhasil membuat surat');

    }

    public function downloadPDF($id)
    {
        $letter = Letter::with('letter_type', 'user')->find($id)->toArray();

        view()->share('letter', $letter);
        // loadView untuk membuat tampilan
        $pdf = PDF::loadView('surat.letter', $letter);

        return $pdf->download('surat.pdf');
    }

    public function PDF($id)
    {
        $letters = Letter::with('user', 'result')->find($id);



        return view('surat.tu.data.PDF', compact('letters'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Letter $letter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $letter = Letter::find($id);
        $letter_type = letter_type::all();
        $user = User::where('role', '=', 'guru')->simplePaginate(5);

        return view('surat.tu.data.edit', compact('letter', 'letter_type', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'letter_type_id' => 'required',
            'letter_perihal' => 'required',
            'recipients' => 'required',
            'attachment' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required',
            'notulis' => 'required',
        ], [
            'letter_type_id.required' => 'Silahkan diisi terlebih dahulu',
            'letter_perihal.required' => 'Silahkan diisi terlebih dahulu',
            'recipients.required' => 'Silahkan diisi terlebih dahulu',
            'content.required' => 'Silahkan diisi terlebih dahulu',
            'notulis.required' => 'Silahkan diisi terlebih dahulu',
        ]);

        $imagePath = $request->file('attachment')->store('public/images');
        $imageName = basename($imagePath);


        Letter::whereId($id)->update([
            'letter_type_id'=>$request->letter_type_id,
            'letter_perihal'=>$request->letter_perihal,
            'recipients'=>$request->recipients,
            'attachment'=>$imageName,
            'content'=>$request->content,
            'notulis'=>$request->notulis,
        ]);

        return redirect()->route('surat.tu.data.index')->with('edited', 'Surat berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Letter::where('id', $id)->delete();
        Result::where('letter_id', $id)->delete();

        return redirect()->back()->with('deleted', 'surat berhasil dihapus');
    }


    // buat guru
    public function indexGuru()
    {

        $letters = Letter::orderBy('letter_type_id', 'DESC')->with('letter_type', 'user')->simplePaginate(5);
        // harus gunain with dengan isi public function yang kita buat

        foreach ($letters as $jumlah){
            $jumlah = Letter::first()->count();
        }

        return view('surat.tu.data.index', compact('letters', 'jumlah'));
    }
}
