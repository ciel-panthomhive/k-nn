<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelas::create(['klas' => 'Entry-level']);
        Kelas::create(['klas' => 'Mid-range']);
        Kelas::create(['klas' => 'High-end']);
        Kelas::create(['klas' => 'Flagship']);
    }
}
