<?php

namespace App\Imports;

use App\Models\Datatest;
use Maatwebsite\Excel\Concerns\ToModel;

class TestImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Datatest([
            'name' => $row[1],
            'ram' => $row[2],
            'internal' => $row[3],
            'baterai' => $row[4],
            'kam_depan' => $row[5],
            'kam_belakang' => $row[6],
            'harga' => $row[7],
            'kid' => $row[8],
        ]);
    }
}
