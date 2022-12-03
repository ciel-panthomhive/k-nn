<?php

namespace App\Http\Controllers;

use App\Imports\UjiImport;
use App\Models\Datatest;
use App\Models\Datauji;
use App\Models\Dtnormalize;
use App\Models\Dunormalize;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Phpml\Classification\KNearestNeighbors;
use PhpParser\Node\Stmt\ElseIf_;

class UjiController extends Controller
{
    public function index()
    {
        $uji = Datauji::with('kelas')
            ->get();
        $kelas = Kelas::all();

        return view('uji.read', ['uji' => $uji, 'kelas' => $kelas]);
    }

    public function add()
    {
        // $uji = Datauji::all();
        $kelas = Kelas::all();

        return view('uji.add', ['kelas' => $kelas]);
    }

    function new(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'ram_u' => 'required|numeric',
            'internal_u' => 'required|numeric',
            'baterai_u' => 'required|numeric',
            'kam_depan_u' => 'required|numeric',
            'kam_belakang_u' => 'required|numeric',
            // 'kid_u' => 'required',
        ]);

        // $file_upload = $request->file('pict');

        // $fileName = time() . '.' . $file_upload->getClientOriginalExtension();

        // $file_upload->move(public_path('uploads'), $fileName);

        $uji = Datauji::create([
            'ram_u' => $request->ram_u,
            'internal_u' => $request->internal_u,
            'baterai_u' => $request->baterai_u,
            'kam_depan_u' => $request->kam_depan_u,
            'kam_belakang_u' => $request->kam_belakang_u,
            'kid_u' => $request->kid_u,
        ]);

        if ($uji) {
            return redirect()->route('uji.read')->with(['success' => 'Data berhasil ditambahkan!']);
        } else {
            return redirect()->route('uji.read')->with(['error' => 'Data gagal ditambahkan!']);
        }
    }

    public function get_arr()
    {
        // $samples = [[8, 11], [9, 10], [2, 4], [3, 1], [7, 10], [4, 2]];
        // $labels = ['Watermelon', 'Watermelon', 'Apple', 'Apple', 'Watermelon', 'Apple'];

        // $classifier = new KNearestNeighbors();
        // $classifier->train($samples, $labels);

        // $prediction = $classifier->predict([8, 10]);
        // echo $prediction;

        // dd($labels);


        // $data = DB::table('datatest')
        //     ->select('ram', 'internal', 'baterai', 'kam_depan', 'kam_belakang')
        //     ->get();
        // // If you are using Eloquent, you can just use ->toarray();
        // // For query builder, you need to change stdClass to array, so I use json_decode()
        // //
        // $data->map(function ($k) {
        //     return array_values((array)$k);
        // });

        $data = Datatest::get(['ram', 'internal', 'baterai', 'kam_depan', 'kam_belakang'])->map(function ($item) {
            return array_values($item->toArray());
        });
        // $data = json_decode(json_encode($data, true), true);

        $samples = $data->toArray();

        // $data_label = DB::table('datatest')
        //     ->select('kid')
        //     ->get()->toArray();
        // If you are using Eloquent, you can just use ->toarray();
        // For query builder, you need to change stdClass to array, so I use json_decode()
        //
        $label = Datatest::pluck('kid')->toArray();
        $classifier = new KNearestNeighbors();

        $classifier->train($samples, $label);
        $hasil = $classifier->predict([4, 128, 4000, 80, 32]);

        var_dump($samples);
        var_dump($label);

        // echo $samples;

        // echo $label;
        echo gettype($samples);

        echo gettype($label);

        // dd($label);
        dd($hasil);
    }

    public function delete($id)
    {
        $uji = Datauji::find($id);

        if (empty($uji)) {
            return redirect()->route('uji.read');
        }

        $uji->delete();

        if ($uji) {
            return redirect()->route('uji.read')->with(['success' => 'Data berhasil dihapus!']);
        } else {
            return redirect()->route('uji.read')->with(['error' => 'Data gagal dihapus!']);
        }
    }

    public function kosong()
    {
        $du = Dunormalize::truncate();
        $uji = Datauji::truncate();

        if ($uji && $du) {
            return redirect()->route('uji.read')->with(['success' => 'Data berhasil dihapus!']);
        } else {
            return redirect()->route('uji.read')->with(['error' => 'Data gagal dihapus!']);
        }
    }

    // public function data()
    // {
    //     return view('uji.import');
    // }

    public function import(Request $request)
    {
        // $test = Excel::import(new TestImport, 'test.xlsx');



        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('uploads', $nama_file);

        // import data
        $duji = Excel::import(new UjiImport, public_path('/uploads/' . $nama_file));

        if ($duji) {
            return redirect()->route('uji.read')->with(['success' => 'Data berhasil di import!']);
        } else {
            return redirect()->route('uji.read')->with(['error' => 'Data gagal di import!']);
        }
    }


    public function norm()
    {
        // $test = Datatest::all();
        $uji = Dunormalize::with(['Datauji'])->get(); //mendapatkan tabel dunormalize dan tabel datauji

        return view('uji.normalize', ['uji' => $uji]); //menampilkan view pada folder uji dengan nama normalize
    }

    #--fungsi normalisasi min max--
    public function normalize()
    {

        Dunormalize::truncate(); //kosongkan tabel dunormalize
        $uji = Datauji::all();
        // $test = Dunormalize::all();

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

        // $max_harga = Datatest::max('harga');
        // $min_harga = Datatest::min('harga');


        $baris = Datauji::count(); //hitung jumlah baris pada tabel datauji


        for ($i = 0; $i < $baris; $i++) { //pengulangan berdasarkan baris datauji/ data di uji per baris

            $pid = $uji[$i]->id;

            //rumus normalisasi = (datauji[ke-i] - nilai minimal pada datatest /(dibagi) selisih maksimal dan minimal data test,
            //dilakukan perkolom, makanya ada kolom ram sendiri, internal sendiri dsb)
            $ram  =  (($uji[$i]->ram_u - $min_ram) / ($max_ram - $min_ram));
            $internal  =  (($uji[$i]->internal_u - $min_inter) / ($max_inter - $min_inter));
            $baterai  =  (($uji[$i]->baterai_u - $min_baterai) / ($max_baterai - $min_baterai));
            $kam_depan  =  (($uji[$i]->kam_depan_u - $min_depan) / ($max_depan - $min_depan));
            $kam_belakang  =  (($uji[$i]->kam_belakang_u - $min_belakang) / ($max_belakang - $min_belakang));

            //untuk normalisasi harga diambil dari rata" harga datatest dengan kelas atau klasifikasi yang sama
            // $avg = 0; //deklarasi variabel, akan diisi nilai hasil dari if else
            // if ($uji[$i]->kid_u == 1) { //jika idi kelas pada datauji = 1
            //     $avg = Datatest::where('kid', 1)->avg('harga'); //maka $avg/harga dari tabel datauji = rata" seluruh harga di datatest yang kid/ id kelasnya=1
            //     // $harga  =  (($avg - $min_harga) / ($max_harga - $min_harga));
            // } elseif ($uji[$i]->kid_u == 2) {
            //     $avg = Datatest::where('kid', 2)->avg('harga'); //maka $avg/harga dari tabel datauji = rata" seluruh harga di datatest yang kid/ id kelasnya=2
            // } else {
            //     $avg = Datatest::where('kid', 3)->avg('harga'); //maka $avg/harga dari tabel datauji = rata" seluruh harga di datatest yang kid/ id kelasnya=3
            // };

            // var_dump($avg);

            // $harga  =  (($avg - $min_harga) / ($max_harga - $min_harga)); //normalisasi harga, $vg berisi rata" data dari if else

            $isi = Dunormalize::create([ //penfisian tabel dunormalize
                'pid_u' => $pid,
                'nram' => $ram,
                'ninternal' => $internal,
                'nbaterai' => $baterai,
                'nkam_depan' => $kam_depan,
                'nkam_belakang' => $kam_belakang,
                // 'nharga' => $harga,
            ]);
        }
        // dd($isi);
        if ($isi) {
            return redirect()->route('norm')->with(['success' => 'Data berhasil dinormalisasi!']);
        } else {
            return redirect()->route('uji.read')->with(['error' => 'Data gagal dinormalisasi!']);
        }
    }

    #--fungsi knn, ini aku maish bingung nanganinnya gimana buat penyimpanan data sama perulangannya--
    public function knn()
    {
        $test = Dtnormalize::all();
        $uji = Dunormalize::all();
        $daata = Datauji::all();

        for ($i = 0; $i < count($uji); $i++) {
            $DISTANCES = array();
            for ($j = 0; $j < count($test); $j++) {
                $dist['distances'] = $this->distance($uji[$i], $test[$j]);
                $dist['id'] = $test[$j]['id'];
                $dist['nklas'] = $test[$j]['nklas'];

                array_push($DISTANCES, $dist);
            }
            sort($DISTANCES); //mengurutkan distance dari terdekat

            $NEIGHBOUR = array();
            for ($p = 0; $p < 15; $p++) {
                if (!isset($NEIGHBOUR[$DISTANCES[$p]['nklas']])) //memastikan nilai variabel/mengecek null atau tidak
                    $NEIGHBOUR[$DISTANCES[$p]['nklas']] = array(); //membentuk variabel menjadi array

                array_push($NEIGHBOUR[$DISTANCES[$p]['nklas']], $DISTANCES[$p]); // isi nilai neighbor berupa id dan nklas berdasarkan nilai $distance ke $i
            }

            //mencari tetangga terbanyak (klasifikasi!!)
            $terbesar =  array();
            foreach (array_keys($NEIGHBOUR) as $paramName) { //array_keys adalah nklas seperti pada neighbour, yg disebut hanya nklas

                if (count($NEIGHBOUR[$paramName])  > count($terbesar)) { //hitung neighbor jengan jumlah nklas terbanyak
                    $terbesar = $NEIGHBOUR[$paramName]; //hasil dari klasifikasi
                }
            }

            // dd($terbesar);
            $klasifikasi = $terbesar[0]['nklas'];
            // dd($klasifikasi);
            // var_dump($klasifikasi);
            // dd($ujidata[$i]->id);
            $id = $daata[$i]->id;
            $penguji = Datauji::find($id);

            $klasi = 0;
            if ($klasifikasi == 0) {
                $klasi = 1;
            } elseif ($klasifikasi > 0 && $klasifikasi < 1) {
                $klasi = 2;
            } elseif ($klasifikasi == 1) {
                $klasi = 3;
            }

            // dd($klasi);
            $penguji->kid_u = trim($klasi);

            // dd($penguji);
            // $penguji->kid_u = trim($klasifikasi);
            // var_dump($penguji->klasifikasi);
            // var_dump($ujidata);
            // dd($uji->nklas);
            $penguji->save();
        }
        if ($penguji) {
            return redirect()->route('uji.read')->with(['success' => 'Data berhasil diedit!']);
        } else {
            return redirect()->route('uji.read')->with(['error' => 'Data gagal diedit!']);
        }
    }

    #--fungsi buat nyari jarak/euclidean--
    private function distance($uji, $test)
    {
        $attrs = array(
            'nram', 'ninternal', 'nbaterai', 'nkam_depan', 'nkam_belakang'
        );

        $value = 0;
        foreach ($attrs as $attr) {
            $value += pow(($uji[$attr] - $test[$attr]), 2);
        }
        return round(sqrt($value), 6);
    }
}
