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
        Kelas::create(['klas' => 'Rendah']);
        Kelas::create(['klas' => 'Menengah']);
        Kelas::create(['klas' => 'Atas']);
    }
}
