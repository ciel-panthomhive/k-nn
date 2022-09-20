<?php

namespace App\Imports;

use App\Models\Datauji;
use Maatwebsite\Excel\Concerns\ToModel;

class UjiImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Datauji([
            // 'name' => $row[1],
            'ram_u' => $row[1],
            'internal_u' => $row[2],
            'baterai_u' => $row[3],
            'kam_depan_u' => $row[4],
            'kam_belakang_u' => $row[5],
            // 'harga_u' => $row[7],
            'kid_u' => $row[6],
        ]);
    }
}
