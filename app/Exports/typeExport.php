<?php

namespace App\Exports;

use App\Models\letter_type;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class typeExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return letter_type::all();
    }

    public function map($letter_type) : array
    {

       return [
        $letter_type['letter_code'],
        $letter_type['name_type'],
        $letter_type->letter->count(),
       ];
    }

    public function headings() : array
    {
        return [
            'Kode_surat',
            'Klasifikasi',
            'surat Tertaut'
        ];
    }
}
