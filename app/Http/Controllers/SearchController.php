<?php

namespace App\Http\Controllers;

use App\Models\Datatest;
use App\Models\Datauji;
use App\Models\Dtnormalize;
use App\Models\Dunormalize;
use App\Models\Kelas;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search($request)
    {
        $kelas = Kelas::all();
        $tes_train = Datatest::with('kelas');
        $test_uji = Datauji::with('kelas');
        $uji = Datauji::all();
        $train = Datatest::all();
        $unorm = Dunormalize::all();
        $tnorm = Dtnormalize::all();

        //fungsi masukkan data ke tabel data uji
        $this->validate($request, [
            'ram_u' => 'required|numeric',
            'internal_u' => 'required|numeric',
            'baterai_u' => 'required|numeric',
            'kam_depan_u' => 'required|numeric',
            'kam_belakang_u' => 'required|numeric',
            // 'kid_u' => 'required',
        ]);

        Datauji::create([
            'ram_u' => $request->ram_u,
            'internal_u' => $request->internal_u,
            'baterai_u' => $request->baterai_u,
            'kam_depan_u' => $request->kam_depan_u,
            'kam_belakang_u' => $request->kam_belakang_u,
            // 'kid_u' => $request->kid_u,
        ]);

        //normalisasi data uji
        Dunormalize::truncate(); //kosongkan tabel dunormalize

        //min max
        $max_ram = Datatest::max('ram'); //cari nilai max pada tabel datatest(tabel untuk data training) kolom ram
        $min_ram = Datatest::min('ram'); //cari nilai min pada tabel datatest(tabel untuk data training) kolom ram

        $max_inter = Datatest::max('internal');
        $min_inter = Datatest::min('internal');

        $max_baterai = Datatest::max('baterai');
        $min_baterai = Datatest::min('baterai');

        $max_depan = Datatest::max('kam_depan');
        $min_depan = Datatest::min('kam_depan');

        $max_belakang = Datatest::max('kam_belakang');
        $min_belakang = Datatest::min('kam_belakang');

        $max_harga = Datatest::max('harga');
        $min_harga = Datatest::min('harga');


        // $baris = Datauji::count();


        for ($i = 0; $i < count($uji); $i++) {

            $pid = $uji[$i]->id;
            $ram  =  (($uji[$i]->ram_u - $min_ram) / ($max_ram - $min_ram));
            $internal  =  (($uji[$i]->internal_u - $min_inter) / ($max_inter - $min_inter));
            $baterai  =  (($uji[$i]->baterai_u - $min_baterai) / ($max_baterai - $min_baterai));
            $kam_depan  =  (($uji[$i]->kam_depan_u - $min_depan) / ($max_depan - $min_depan));
            $kam_belakang  =  (($uji[$i]->kam_belakang_u - $min_belakang) / ($max_belakang - $min_belakang));

            //pengisian tabel dunormalize
            $isi = Dunormalize::create([
                'pid_u' => $pid,
                'nram' => $ram,
                'ninternal' => $internal,
                'nbaterai' => $baterai,
                'nkam_depan' => $kam_depan,
                'nkam_belakang' => $kam_belakang,
                // 'nharga' => $harga,
            ]);
        }

        //proses knn
        //perhitungan euclid





        $hasil = Datatest::with('kelas');



        return view('hasil', ['hasil' => $hasil]);
    }
}
