<?php

namespace App\Http\Controllers;

use App\Models\Datatest;
use App\Models\Datauji;
use App\Models\Dtnormalize;
use App\Models\Dunormalize;
use App\Models\Hasil;
use App\Models\Kelas;
use Illuminate\Http\Request;

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
        $this->validate($request, [
            'ram_u' => 'required|numeric',
            'internal_u' => 'required|numeric',
            'baterai_u' => 'required|numeric',
            'kam_depan_u' => 'required|numeric',
            'kam_belakang_u' => 'required|numeric',
            // 'kid_u' => 'required',
        ]);

        $du = Datauji::create([
            'ram_u' => $request->ram_u,
            'internal_u' => $request->internal_u,
            'baterai_u' => $request->baterai_u,
            'kam_depan_u' => $request->kam_depan_u,
            'kam_belakang_u' => $request->kam_belakang_u,
            // 'kid_u' => $request->kid_u,
        ]);
        // dd($du->id);
        //normalisasi data uji

        // if ($du) {
        //     return redirect()->route('uji.read')->with(['success' => 'Data berhasil ditambahkan!']);
        // } else {
        //     return redirect()->route('uji.read')->with(['error' => 'Data gagal ditambahkan!']);
        // }
        Dunormalize::truncate(); //kosongkan tabel dunormalize

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

        $max_harga = Datatest::max('harga');
        $min_harga = Datatest::min('harga');


        // $baris = Datauji::count();
        $id = $du->id;
        // Datauji::find($id);

        // dd($id);


        // for ($i = 0; $i < count($uji); $i++) {

        // $pid = $du->id;
        $ram  =  (($du->ram_u - $min_ram) / ($max_ram - $min_ram));
        $internal  =  (($du->internal_u - $min_inter) / ($max_inter - $min_inter));
        $baterai  =  (($du->baterai_u - $min_baterai) / ($max_baterai - $min_baterai));
        $kam_depan  =  (($du->kam_depan_u - $min_depan) / ($max_depan - $min_depan));
        $kam_belakang  =  (($du->kam_belakang_u - $min_belakang) / ($max_belakang - $min_belakang));

        // dd($ram);
        //pengisian tabel dunormalize
        $isi = Dunormalize::create([
            'id' => $id,
            'nram' => $ram,
            'ninternal' => $internal,
            'nbaterai' => $baterai,
            'nkam_depan' => $kam_depan,
            'nkam_belakang' => $kam_belakang,
            // 'nharga' => $harga,
        ]);
        // }
        // dd($isi);


        //proses knn
        //perhitungan euclid
        $DISTANCES = array();
        for ($j = 0; $j < count($tnorm); $j++) {
            $dist['distances'] = $this->distance1($isi, $tnorm[$j]);
            $dist['pid'] = $tnorm[$j]['pid'];
            $dist['nklas'] = $tnorm[$j]['nklas'];

            array_push($DISTANCES, $dist); //mengisi array distance dengan data dari $dist
        }

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

        $uji = Datauji::find($id);
        // dd($uji);
        $nklas = $terbesar[0]['nklas'];
        // dd($nklas);
        $uji->kid_u = trim($nklas);

        // dd($uji->nklas);
        $uji->save();
        // dd($uji);

        // $pidu = $isi->pid_u;
        $ujinorm = Dunormalize::find($id);

        // dd($ujinorm);
        //normalisasi kelas datauji
        $avg = 0;
        if ($uji->kid_u == 1) {
            $avg = Datatest::where('kid', 1)->avg('harga');
        } elseif ($uji->kid_u == 2) {
            $avg = Datatest::where('kid', 2)->avg('harga');
        } elseif ($uji->kid_u == 3) {
            $avg = Datatest::where('kid', 3)->avg('harga');
        };

        // var_dump($avg);

        $harga  =  (($avg - $min_harga) / ($max_harga - $min_harga));


        $ujinorm->nharga = trim($harga);
        // dd($ujinorm->nharga);

        $ujinorm->save();
        // dd($ujinorm);


        //-------------PAHAMI BAGIAN INI!!!------------
        //knn sistem rekomendasi
        //rumus euclid
        $DISTANCES2 = array();
        for ($j = 0; $j < count($tnorm); $j++) {
            $dist2['distances'] = $this->distance2($ujinorm, $tnorm[$j]);
            $dist2['pid'] = $tnorm[$j]['pid'];
            $dist2['nklas'] = $tnorm[$j]['nklas'];

            array_push($DISTANCES2, $dist2); //mengisi array distance dengan data dari $dist
        }

        // var_dump($DISTANCES2);
        //mengurutkan distance dari terdekat
        sort($DISTANCES2); //->dia bernilai true, butuh penjelasan
        // dd($DISTANCES2);

        //memetakan tetangga (belom di coba!!)
        $NEIGHBOUR2 = array();
        for ($q = 0; $q < $k; $q++) {
            if (!isset($NEIGHBOUR2[$DISTANCES2[$q]['pid']])) //memastikan nilai variabel/mengecek null atau tidak
                $NEIGHBOUR2[$DISTANCES2[$q]['pid']] = array(); //membentuk variabel menjadi array

            array_push($NEIGHBOUR2[$DISTANCES2[$q]['pid']], $DISTANCES2[$q]); // isi nilai neighbor berupa id dan nklas berdasarkan nilai $distance ke $i
        }

        // echo ($NEIGHBOUR2[$q]);

        // foreach ($NEIGHBOUR2 as $object) {
        //     $arr[] =  (array) $object;
        // }
        // dd($arr[0]->pid);
        // $hasil = (object)$NEIGHBOUR2;
        // dd($hasil);

        // $id_hasil = $NEIGHBOUR2->pid;
        // dd($NEIGHBOUR2);

        foreach (array_keys($NEIGHBOUR2) as $param) { //array_keys adalah nklas seperti pada neighbour, yg disebut hanya nklas

            $hasil = Hasil::create([
                'id_hasil' => trim($param),
                // 'nharga' => $harga,
            ]);
        }

        if ($hasil) {
            return redirect()->route('hasil')->with(['success' => 'Data hasil rekomendasi']);
        } else {
            return redirect()->route('dashboard')->with(['error' => 'Data gagal dimuat']);
        }



        // $key = array_keys($NEIGHBOUR2);
        // $arr_key = (object)$key;

        // dd($arr_key);

        // for ($h = 0; $h < count($NEIGHBOUR2); $h++) {
        //     $hasil = Hasil::create([
        //         'id_hasil' => trim($arr_key),
        //         // 'nharga' => $harga,
        //     ]);
        // }


        // return view('hasil', ['hasil' => $hasil]);
    }


    private function distance1($uji, $test)
    {
        $attrs = array(
            // 'data_semester', 'data_IPK', 'data_gaji_ortu', 'data_UKT', 'data_tanggungan'
            'nram', 'ninternal', 'nbaterai', 'nkam_depan', 'nkam_belakang' //atribut dari tabel dtnormalize dan dunormalize
        );
        $value = 0; //deklarasi nilai value, akan di update berdasarkan nilai value dibawah
        foreach ($attrs as $attr) {
            //value = jumlah (atribut kolom datauji - atribut kolom datatest)^2
            $value += pow(($uji[$attr] - $test[$attr]), 2);
        }
        return round(sqrt($value), 6); // value = jumlah value diatas diakar, dibulatkan menjadi maksimal 6 angka dibelakang koma)
    }

    private function distance2($uji, $test)
    {
        $attrs = array(
            // 'data_semester', 'data_IPK', 'data_gaji_ortu', 'data_UKT', 'data_tanggungan'
            'nram', 'ninternal', 'nbaterai', 'nkam_depan', 'nkam_belakang', 'nharga' //atribut dari tabel dtnormalize dan dunormalize
        );
        $value = 0; //deklarasi nilai value, akan di update berdasarkan nilai value dibawah
        foreach ($attrs as $attr) {
            //value = jumlah (atribut kolom datauji - atribut kolom datatest)^2
            $value += pow(($uji[$attr] - $test[$attr]), 2);
        }
        return round(sqrt($value), 6); // value = jumlah value diatas diakar, dibulatkan menjadi maksimal 6 angka dibelakang koma)
    }

    public function hasil()
    {
        $hasil = Hasil::with('datatest')->get();

        return view('hasil', ['hasil' => $hasil]);
    }
}
