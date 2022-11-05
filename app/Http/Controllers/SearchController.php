<?php

namespace App\Http\Controllers;

use App\Models\Carinorm;
use App\Models\Datatest;
use App\Models\Datauji;
use App\Models\Dtnormalize;
use App\Models\Dunormalize;
use App\Models\Hasil;
use App\Models\Kelas;
use App\Models\Pencarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\ElseIf_;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Datauji::truncate();
        Hasil::truncate();
        // $tes_train = Datatest::with('kelas');
        // $test_uji = Datauji::with('kelas');
        // $train = Datatest::all();
        // $unorm = Dunormalize::all();
        $tnorm = Dtnormalize::all();
        $k = 5;
        // $id = $this->id;
        //fungsi masukkan data ke tabel data uji
        // $this->validate($request, [
        //     'ram_u' => 'numeric',
        //     'internal_u' => 'numeric',
        //     'baterai_u' => 'numeric',
        //     'kam_depan_u' => 'numeric',
        //     'kam_belakang_u' => 'numeric',
        //     'harga_u' => 'numeric',
        //     // 'kid_u' => 'required',
        // ]);

        $du = Pencarian::create([
            'ram_u' => $request->ram_u,
            'internal_u' => $request->internal_u,
            'baterai_u' => $request->baterai_u,
            'kam_depan_u' => $request->kam_depan_u,
            'kam_belakang_u' => $request->kam_belakang_u,
            'harga_u' => $request->harga_u,
            // 'kid_u' => $request->kid_u,
        ]);
        // dd($du->ram_u);
        $id = $du->id;
        $ram_u = $du->ram_u;
        $internal_u = $du->internal_u;
        $baterai_u = $du->baterai_u;
        $kam_depan_u = $du->kam_depan_u;
        $kam_belakang_u = $du->kam_belakang_u;
        $harga_u = $du->harga_u;
        //normalisasi data uji

        // if ($du) {
        //     return redirect()->route('uji.read')->with(['success' => 'Data berhasil ditambahkan!']);
        // } else {
        //     return redirect()->route('uji.read')->with(['error' => 'Data gagal ditambahkan!']);
        // }
        // Dunormalize::truncate(); //kosongkan tabel dunormalize

        // min max
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

        $max_kid = Datatest::max('kid');
        $min_kid = Datatest::min('kid');


        // $baris = Datauji::count();
        // $id = $du->id;
        // Datauji::find($id);

        // dd($id);


        // for ($i = 0; $i < count($uji); $i++) {

        // $pid = $du->id;
        // dd($du->ram_u);
        $ram = null;
        $internal = null;
        $baterai = null;
        $kam_depan  = null;
        $kam_belakang  = null;
        $harga = null;
        $kelas = null;
        // dd($du->ram_u);
        if ($ram_u) {
            // dd($ram  =  (($ram_u - $min_ram) / ($max_ram - $min_ram)));
            $ram  =  (($ram_u - $min_ram) / ($max_ram - $min_ram));
        }
        if ($internal_u) {
            $internal  =  (($internal_u - $min_inter) / ($max_inter - $min_inter));
        }
        if ($baterai_u) {
            $baterai  =  (($baterai_u - $min_baterai) / ($max_baterai - $min_baterai));
        }
        if ($kam_depan_u) {
            $kam_depan  =  (($kam_depan_u - $min_depan) / ($max_depan - $min_depan));
        }
        if ($kam_depan_u) {
            $kam_belakang  =  (($kam_belakang_u - $min_belakang) / ($max_belakang - $min_belakang));
        }
        if ($harga_u) {
            $harga = $harga_u;
        }

        // dd($ram);
        //pengisian tabel dunormalize
        $isi = Carinorm::create([
            'id' => $id,
            'nram' => $ram,
            'ninternal' => $internal,
            'nbaterai' => $baterai,
            'nkam_depan' => $kam_depan,
            'nkam_belakang' => $kam_belakang,
            'nharga' => $harga,
        ]);
        // }
        // dd($isi);


        //proses knn
        //perhitungan euclid
        $DISTANCES = array();
        for ($j = 0; $j < count($tnorm); $j++) {
            $dist['distances'] = $this->distance($isi, $tnorm[$j], $ram, $internal, $baterai, $kam_depan, $kam_belakang, $harga, $kelas);
            $dist['pid'] = $tnorm[$j]['pid'];
            $dist['nklas'] = $tnorm[$j]['nklas'];

            array_push($DISTANCES, $dist); //mengisi array distance dengan data dari $dist
        }
        // dd($DISTANCES);
        // var_dump($DISTANCES);
        //mengurutkan distance dari terdekat
        sort($DISTANCES); //->dia bernilai true, butuh penjelasan
        // dd($DISTANCES);

        //memetakan tetangga (belom di coba!!)
        $NEIGHBOUR = array();
        for ($i = 0; $i < $k; $i++) {
            if (!isset($NEIGHBOUR[$DISTANCES[$i]['nklas']])) //memastikan nilai variabel/mengecek null atau tidak
                $NEIGHBOUR[$DISTANCES[$i]['nklas']] = array(); //membentuk variabel menjadi array

            array_push($NEIGHBOUR[$DISTANCES[$i]['nklas']], $DISTANCES[$i]); // isi nilai neighbor berupa id dan nklas berdasarkan nilai $distance ke $i
        }

        // dd($NEIGHBOUR);

        //mencari tetangga terbanyak (klasifikasi!!)
        $terbesar =  array();
        foreach (array_keys($NEIGHBOUR) as $paramName) { //array_keys adalah nklas seperti pada neighbour, yg disebut hanya nklas

            if (count($NEIGHBOUR[$paramName])  > count($terbesar)) { //hitung neighbor jengan jumlah nklas terbanyak
                $terbesar = $NEIGHBOUR[$paramName]; //hasil dari klasifikasi
            }
        }

        // dd($terbesar);

        //update tabel datauji bagian klasifikasi
        //$data_uji[$i]['data_label'] = $terbesar[0]['data_label']; //update nilai label (lulus / tidak lulus), tolong dikaji lagi karena cara update mungkin beda

        $cari = Pencarian::find($id);
        // dd($uji);
        $nklas = $terbesar[0]['nklas'];
        // dd($nklas);
        // $klasi = 0;
        if ($nklas == 0) {
            $kelas = 1;
        } elseif ($nklas > 0 && $nklas < 1) {
            $kelas = 2;
        } elseif ($nklas == 1) {
            $kelas = 3;
        }

        // dd($klasi);
        $cari->kid_u = trim($kelas);

        // dd($uji->nklas);
        $cari->save();
        // dd($uji);

        // $pidu = $isi->pid_u;
        $carinorm = Carinorm::find($id);

        // dd($ujinorm);
        //normalisasi kelas datauji
        // $avg = 0;
        // if ($uji->kid_u == 1) {
        //     $avg = Datatest::where('kid', 1)->avg('harga');
        // } elseif ($uji->kid_u == 2) {
        //     $avg = Datatest::where('kid', 2)->avg('harga');
        // } elseif ($uji->kid_u == 3) {
        //     $avg = Datatest::where('kid', 3)->avg('harga');
        // };

        // var_dump($avg);

        // $harga  =  (($avg - $min_harga) / ($max_harga - $min_harga));
        // dd($uji->kid_u);
        $kid = (($cari->kid_u - $min_kid) / ($max_kid - $min_kid));

        $carinorm->nklas = trim($kid);
        // dd($ujinorm->nharga);

        $carinorm->save();
        // dd($carinorm);


        //-------------PAHAMI BAGIAN INI!!!------------
        //knn sistem rekomendasi
        //rumus euclid
        $DISTANCES2 = array();
        for ($j = 0; $j < count($tnorm); $j++) {
            $dist2['distances'] = $this->distance($isi, $tnorm[$j], $ram, $internal, $baterai, $kam_depan, $kam_belakang, $harga, $kelas);
            $dist2['pid'] = $tnorm[$j]['pid'];
            $dist2['nklas'] = $tnorm[$j]['nklas'];
            $dist2['harga'] = $tnorm[$j]['nharga'];
            array_push($DISTANCES2, $dist2); //mengisi array distance dengan data dari $dist
        }

        // var_dump($DISTANCES2);
        //mengurutkan distance dari terdekat
        sort($DISTANCES2); //->dia bernilai true, butuh penjelasan
        // dd($DISTANCES2);
        //-----------------------------------------------------------------------------------------------------------------------------------------------------------------//
        //memetakan tetangga (belom di coba!!)
        // $NEIGHBOUR2 = array();
        // for ($q = 0; $q < $k; $q++) {
        //     if (!isset($NEIGHBOUR2[$DISTANCES2[$q]['pid']])) //memastikan nilai variabel/mengecek null atau tidak
        //         $NEIGHBOUR2[$DISTANCES2[$q]['pid']] = array(); //membentuk variabel menjadi array

        //     array_push($NEIGHBOUR2[$DISTANCES2[$q]['pid']], $DISTANCES2[$q]); // isi nilai neighbor berupa id dan nklas berdasarkan nilai $distance ke $i
        // }

        // foreach (array_keys($NEIGHBOUR2) as $param) { //array_keys adalah nklas seperti pada neighbour, yg disebut hanya nklas
        foreach (array_keys($DISTANCES2) as $param) {
            // dd($DISTANCES2[$param]['harga']);
            $hasil = Hasil::create([
                'id_hasil' => trim(($DISTANCES2[$param]['pid'])),
                'harga' => trim(($DISTANCES2[$param]['harga'])),
            ]);
        }

        // dd($harga);

        if ($harga) {
            // $hasil = Hasil::with('datatest')->get();
            // $hasil = Hasil::with('datatest')
            // ->where('harga', '<', $harga)
            // ->get();
            // dd($harga);

            $hasil = Hasil::with('datatest')
                ->where('harga', '<', $harga)
                ->take(5)->get();

            return view('hasil', ['hasil' => $hasil]);
        } else {
            $hasil = Hasil::with('datatest')
                ->take(5)
                ->get();
            return view('hasil', ['hasil' => $hasil]);
        }

        // if ($hasil) {
        //     return redirect()->route('hasil', $harga)->with(['success' => 'Data hasil rekomendasi']);
        // } else {
        //     return redirect()->route('dashboard')->with(['error' => 'Data gagal dimuat']);
        // }
    }


    private function distance($uji, $test, $ram, $internal, $baterai, $kam_depan, $kam_belakang, $harga, $kelas)
    {
        //example atrribut
        $attrs = [];

        if ($ram) {
            $attrs[] = 'nram';
        }
        if ($internal) {
            $attrs[] = 'ninternal';
        }
        if ($baterai) {
            $attrs[] = 'nbaterai';
        }
        if ($kam_depan) {
            $attrs[] = 'nkam_depan';
        }
        if ($kam_belakang) {
            $attrs[] = 'nkam_belakang';
        }
        if ($harga) {
            $attrs[] = 'nharga';
        }
        if ($kelas) {
            $attrs[] = 'nklas';
        }
        // dd($attrs);
        // $attrs = array(
        //     // 'data_semester', 'data_IPK', 'data_gaji_ortu', 'data_UKT', 'data_tanggungan'
        //     'nram', 'ninternal', 'nbaterai', 'nkam_depan', 'nkam_belakang' //atribut dari tabel dtnormalize dan dunormalize
        // );
        $value = 0; //deklarasi nilai value, akan di update berdasarkan nilai value dibawah
        foreach ($attrs as $attr) {
            //value = jumlah (atribut kolom datauji - atribut kolom datatest)^2
            $value += pow(($uji[$attr] - $test[$attr]), 2);
        }
        return round(sqrt($value), 6); // value = jumlah value diatas diakar, dibulatkan menjadi maksimal 6 angka dibelakang koma)
    }

    public function hasil($id)
    {
        $has = Hasil::find($id);
        $hasil = Hasil::with('datatest')->get();

        return view('hasil', ['hasil' => $hasil]);
    }
}
