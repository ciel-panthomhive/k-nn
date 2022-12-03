<?php

namespace App\Http\Controllers;

use App\Models\Datatest;
use App\Models\Dtnormalize;
use App\Models\Uji;
use App\Models\Ujinorm;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Queue\Events\Looping;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Finder\Iterator\SortableIterator;

class PengujianController extends Controller
{
    public function pengujian(Request $request)
    {
        Uji::truncate();
        Ujinorm::truncate();

        $test = Datatest::all();

        // $data = Datatest::get(['name', 'ram', 'internal', 'baterai', 'kam_depan', 'kam_belakang', 'harga', 'kid'])->map(function ($item) {
        //     return array_values($item->toArray());
        // });

        // $data = DB::table('datatest')
        //     ->select('name', 'ram', 'internal', 'baterai', 'kam_depan', 'kam_belakang', 'harga', 'kid')
        //     ->get();

        // $datatest = $data->toArray();

        // shuffle($datatest);
        $datatest = array();
        for ($j = 0; $j < count($test); $j++) {
            // dd($test[$j]['id']);
            // dd($datatest[$test[$j]]);
            // if (!isset($datatest[$test[$j]['id']]))
            //     $datatest[$test[$j]['id']] = array();
            // $shuffle['id'] = $loop->iteration;
            $shuffle['id'] = $test[$j]['id'];
            $shuffle['name'] = $test[$j]['name'];
            $shuffle['ram'] = $test[$j]['ram'];
            $shuffle['internal'] = $test[$j]['internal'];
            $shuffle['baterai'] = $test[$j]['baterai'];
            $shuffle['kam_depan'] = $test[$j]['kam_depan'];
            $shuffle['kam_belakang'] = $test[$j]['kam_belakang'];
            $shuffle['harga'] = $test[$j]['harga'];
            $shuffle['kid'] = $test[$j]['kid'];

            array_push($datatest, $shuffle);
        }
        // for ($a = 0; $a < 50; $a++) {
        //     var_dump($datatest[$a]);
        // }

        shuffle($datatest); //mengacak datatest

        // $result = shuffle($datatest);
        // print_r($result);

        $det = array(); //mengambil 20 datatest/train
        for ($q = 0; $q < 20; $q++) {
            $datatest[$q];
            // if (!isset($det[$datatest[$q]['id']]))
            //     $det[$datatest[$q]['id']] = array();

            // array_push($det[$datatest[$q]['id']], $datatest[$q]);
            array_push($det, $datatest[$q]);
        }
        // var_dump($det);

        sort($det);

        // dd($det);

        // var_dump($det);

        //memasukkan datatest ke dalam tabel
        foreach (array_keys($det) as $param) {
            // dd($datatest[$param]);
            $ass = Uji::create([
                'id' => trim($datatest[$param]['id']),
                'name' => trim($datatest[$param]['name']),
                'ram' => trim($datatest[$param]['ram']),
                'internal' => trim($datatest[$param]['internal']),
                'baterai' => trim($datatest[$param]['baterai']),
                'kam_depan' => trim($datatest[$param]['kam_depan']),
                'kam_belakang' => trim($datatest[$param]['kam_belakang']),
                'harga' => trim($datatest[$param]['harga']),
                'kid' => trim($datatest[$param]['kid']),
                // 'nharga' => $harga,
            ]);
            // dd($datatest[$param]['ram']);
            // echo ($ass);
        }
        // sort($ass);
        // dd($ass);

        //normalisasi datatest
        $tabeluji = Uji::all();

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

        for ($s = 0; $s < count($tabeluji); $s++) {
            $pid = $tabeluji[$s]->id;
            $name = $tabeluji[$s]->name;
            $ram  =  (($tabeluji[$s]->ram - $min_ram) / ($max_ram - $min_ram));
            $internal  =  (($tabeluji[$s]->internal - $min_inter) / ($max_inter - $min_inter));
            $baterai  =  (($tabeluji[$s]->baterai - $min_baterai) / ($max_baterai - $min_baterai));
            $kam_depan  =  (($tabeluji[$s]->kam_depan - $min_depan) / ($max_depan - $min_depan));
            $kam_belakang  =  (($tabeluji[$s]->kam_belakang - $min_belakang) / ($max_belakang - $min_belakang));
            // $harga  =  (($tabeluji[$s]->harga - $min_harga) / ($max_harga - $min_harga));
            $harga = ($tabeluji[$s]->harga);
            // $klas = $tabeluji[$s]->kid;
            // dd($harga);
            // dd($pid);


            $isi = Ujinorm::create([
                'id' => $pid,
                'nname' => $name,
                'nram' => $ram,
                'ninternal' => $internal,
                'nbaterai' => $baterai,
                'nkam_depan' => $kam_depan,
                'nkam_belakang' => $kam_belakang,
                'nharga' => $harga,
                // 'nklas' => $klas,
            ]);
        }
        // dd($isi);
        $data_uji = Ujinorm::all();
        $data_train = Dtnormalize::all();
        $ujidata = Uji::all();

        for ($i = 0; $i < count($data_uji); $i++) {
            // dd($ujidata[$i]);
            $DISTANCES = array();
            for ($k = 0; $k < count($data_train); $k++) {
                $dist['distances'] = $this->distance($data_uji[$i], $data_train[$k]);
                $dist['id'] = $data_train[$k]['id'];
                $dist['nklas'] = $data_train[$k]['nklas'];
                // echo json_encode( $dist ).'<br>' ;
                array_push($DISTANCES, $dist);
            }
            sort($DISTANCES);

            // dd($DISTANCES);

            //memetakan tetangga
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
            $id = $ujidata[$i]->id;
            $penguji = Uji::find($id);

            // dd($penguji);
            $klasi = 0;
            if ($klasifikasi == 0) {
                $klasi = 1;
            } elseif ($klasifikasi > 0 && $klasifikasi < 1) {
                $klasi = 2;
            } elseif ($klasifikasi == 1) {
                $klasi = 3;
            }

            // dd($klasi);
            $penguji->klasifikasi = trim($klasi);

            // var_dump($penguji->klasifikasi);
            // var_dump($ujidata);
            // dd($uji->nklas);
            $penguji->save();
        }



        if ($penguji) {
            return redirect()->route('modal')->with(['success' => 'Data berhasil di uji!']);
        } else {
            return redirect()->route('home')->with(['error' => 'Data gagal di uji!']);
        }
    }

    private function distance($uji, $test)
    {
        $attrs = array(
            'nram', 'ninternal', 'nbaterai', 'nkam_depan', 'nkam_belakang' //atribut dari tabel dtnormalize dan dunormalize
        );
        $value = 0; //deklarasi nilai value, akan di update berdasarkan nilai value dibawah
        foreach ($attrs as $attr) {
            //value = jumlah (atribut kolom datauji - atribut kolom datatest)^2
            $value += pow(($uji[$attr] - $test[$attr]), 2);
        }
        return round(sqrt($value), 6); // value = jumlah value diatas diakar, dibulatkan menjadi maksimal 6 angka dibelakang koma)
    }

    public function uji()
    {
        // $test = Datatest::all();
        $uji = Uji::with(['Datatest', 'kelas1', 'kelas2'])->get();

        return view('testing.uji', ['uji' => $uji]);
    }

    public function norm()
    {
        $dt = Ujinorm::with(['Uji'])->get();

        return view('testing.ujinorm', ['dt' => $dt]);
    }
}
