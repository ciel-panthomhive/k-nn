<?php

namespace App\Http\Controllers;

use App\Imports\UjiImport;
use App\Models\Datatest;
use App\Models\Datauji;
use App\Models\Dtnormalize;
use App\Models\Dunormalize;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\ElseIf_;

class UjiController extends Controller
{
    public function index()
    {
        $uji = Datauji::all();
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
            'harga_u' => 'required',
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
            'harga_u' => $request->harga_u,
        ]);

        if ($uji) {
            return redirect()->route('uji.read')->with(['success' => 'Data berhasil ditambahkan!']);
        } else {
            return redirect()->route('uji.read')->with(['error' => 'Data gagal ditambahkan!']);
        }
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
        $uji = Dunormalize::with(['Datauji'])->get();

        return view('uji.normalize', ['uji' => $uji]);
    }

    //fungsi normalisasi
    public function normalize()
    {

        Dunormalize::truncate();
        $uji = Datauji::all();
        // $test = Dunormalize::all();

        //min max
        $max_ram = Datatest::max('ram_u');
        $min_ram = Datatest::min('ram_u');

        $max_inter = Datatest::max('internal_u');
        $min_inter = Datatest::min('internal_u');

        $max_baterai = Datatest::max('baterai_u');
        $min_baterai = Datatest::min('baterai_u');

        $max_depan = Datatest::max('kam_depan_u');
        $min_depan = Datatest::min('kam_depan_u');

        $max_belakang = Datatest::max('kam_belakang_u');
        $min_belakang = Datatest::min('kam_belakang_u');

        $max_harga = Datatest::max('harga_u');
        $min_harga = Datatest::min('harga_u');


        $baris = Datauji::count();


        for ($i = 0; $i < $baris; $i++) {

            $pid = $uji[$i]->id;
            $ram  =  (($uji[$i]->ram_u - $min_ram) / ($max_ram - $min_ram));
            $internal  =  (($uji[$i]->internal_u - $min_inter) / ($max_inter - $min_inter));
            $baterai  =  (($uji[$i]->baterai_u - $min_baterai) / ($max_baterai - $min_baterai));
            $kam_depan  =  (($uji[$i]->kam_depan_u - $min_depan) / ($max_depan - $min_depan));
            $kam_belakang  =  (($uji[$i]->kam_belakang_u - $min_belakang) / ($max_belakang - $min_belakang));

            $avg = 0;
            if ($uji[$i]->kid_u = 1) {
                $avg = Datatest::where('kid', 1)->avg('harga');
                // $harga  =  (($avg - $min_harga) / ($max_harga - $min_harga));
            } elseif ($uji[$i]->kid_u = 2) {
                $avg = Datatest::where('kid', 2)->avg('harga');
            } else {
                $avg = Datatest::where('kid', 3)->avg('harga');
            };

            $harga  =  (($avg - $min_harga) / ($max_harga - $min_harga));

            $isi = Dunormalize::create([
                'pid_u' => $pid,
                'ujiram' => $ram,
                'ujiinternal' => $internal,
                'ujibaterai' => $baterai,
                'ujikam_depan' => $kam_depan,
                'ujikam_belakang' => $kam_belakang,
                'ujiharga' => $harga,
            ]);
        }
        // dd($isi);
        if ($isi) {
            return redirect()->route('norm')->with(['success' => 'Data berhasil dinormalisasi!']);
        } else {
            return redirect()->route('uji.read')->with(['error' => 'Data gagal dinormalisasi!']);
        }
    }

    public function knn()
    {
        $test = Dtnormalize::all();
        $uji = Dunormalize::all();

        for ($i = 0; $i < count($uji); $i++) {
            $DISTANCES = array();
            for ($j = 0; $j < count($test); $j++) {
                $dist['distances'] = $this->distance($uji[$i], $test[$j]);
                $dist['name'] = $test[$j]['name'];
                $dist['kid'] = $test[$j]['kid'];

                array_push($DISTANCES, $dist);
            }
            sort($DISTANCES); //mengurutkan distance dari terdekat
        }
    }

    private function distance($uji, $test)
    {
        $attrs = array(
            // 'data_semester', 'data_IPK', 'data_gaji_ortu', 'data_UKT', 'data_tanggungan'
            'nram', 'ninternal', 'nbaterai', 'nkam_depan', 'nkam_belakang', 'nharga'
        );
        $value = 0;
        foreach ($attrs as $attr) {
            $value += pow(($uji[$attr] - $test[$attr]), 2);
        }
        return round(sqrt($value), 6);
    }
}
