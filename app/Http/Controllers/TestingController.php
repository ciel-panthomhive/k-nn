<?php

namespace App\Http\Controllers;

use App\Imports\TestImport;
use App\Models\Datatest;
use App\Models\Dtnormalize;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TestingController extends Controller
{
    public function add()
    {
        // $test = Datatest::all();
        $kelas = Kelas::all();

        return view('testing.add', ['kelas' => $kelas]);
    }

    function new(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required',
            'ram' => 'required|numeric',
            'internal' => 'required|numeric',
            'baterai' => 'required|numeric',
            'kam_depan' => 'required|numeric',
            'kam_belakang' => 'required|numeric',
            'harga' => 'required|numeric',
            'kid' => 'required',
        ]);

        // $file_upload = $request->file('pict');

        // $fileName = time() . '.' . $file_upload->getClientOriginalExtension();

        // $file_upload->move(public_path('uploads'), $fileName);

        $test = Datatest::create([
            'name' => $request->name,
            'ram' => $request->ram,
            'internal' => $request->internal,
            'baterai' => $request->baterai,
            'kam_depan' => $request->kam_depan,
            'kam_belakang' => $request->kam_belakang,
            'harga' => $request->harga,
            'kid' => $request->kid,
        ]);

        if ($test) {
            return redirect()->route('home')->with(['success' => 'Data berhasil ditambahkan!']);
        } else {
            return redirect()->route('home')->with(['error' => 'Data gagal ditambahkan!']);
        }
    }

    public function edit($id)
    {
        $test = Datatest::find($id);
        $kelas = Kelas::all();

        return view('testing.edit', ['test' => $test, 'kelas' => $kelas]);
    }

    public function update($id, Request $request)
    {
        $testing = Datatest::find($id);

        if (empty($testing)) {
            return redirect()->route('test.edit');
        }

        $this->validate($request, [
            'name' => 'required',
            'ram' => 'required|numeric',
            'internal' => 'required|numeric',
            'baterai' => 'required|numeric',
            'kam_depan' => 'required|numeric',
            'kam_belakang' => 'required|numeric',
            'harga' => 'required|numeric',
            'kid' => 'required',
        ]);

        // $file_upload = $request->file('pict');

        // if ($file_upload) {


        //     $fileName = time() . '.' . $file_upload->getClientOriginalExtension();

        //     $file_upload->move(public_path('uploads'), $fileName);

        //     $barang->pict = $fileName;
        // }

        $testing->name = trim($request->name);
        $testing->ram = trim($request->ram);
        $testing->internal = trim($request->internal);
        $testing->baterai = trim($request->baterai);
        $testing->kam_depan = trim($request->kam_depan);
        $testing->kam_belakang = trim($request->kam_belakang);
        $testing->harga = trim($request->harga);
        $testing->kid = trim($request->kid);

        $testing->save();

        if ($testing) {
            return redirect()->route('home')->with(['success' => 'Data berhasil diedit!']);
        } else {
            return redirect()->route('home')->with(['error' => 'Data gagal diedit!']);
        }
    }

    public function delete($id)
    {
        $test = Datatest::find($id);

        if (empty($test)) {
            return redirect()->route('home');
        }

        $test->delete();

        if ($test) {
            return redirect()->route('home')->with(['success' => 'Data berhasil dihapus!']);
        } else {
            return redirect()->route('home')->with(['error' => 'Data gagal dihapus!']);
        }
    }

    public function kosong()
    {
        $dt = Dtnormalize::truncate();
        $test = Datatest::truncate();

        if ($test && $dt) {
            return redirect()->route('home')->with(['success' => 'Data berhasil dihapus!']);
        } else {
            return redirect()->route('home')->with(['error' => 'Data gagal dihapus!']);
        }
    }

    // public function data()
    // {
    //     return view('test.import');
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
        $dtest = Excel::import(new TestImport, public_path('/uploads/' . $nama_file));

        if ($dtest) {
            return redirect()->route('home')->with(['success' => 'Data berhasil di import!']);
        } else {
            return redirect()->route('home')->with(['error' => 'Data gagal di import!']);
        }
    }

    //fungsi normalisasi
    public function normalize()
    {

        Dtnormalize::truncate();
        $train = Datatest::all();
        // $test = Dtnormalize::all();

        //min max
        $max_ram = Datatest::max('ram');
        $min_ram = Datatest::min('ram');
        // $nor_ram = $max_ram - $min_ram;
        // $nor_ram = Datatest::max('ram') - Datatest::min('ram');

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

        $baris = Datatest::count();

        // $this->validate($request, [
        //     'pid' => 'required',
        //     // 'name' => 'required',
        //     'ram' => 'required|numeric',
        //     'internal' => 'required|numeric',
        //     'baterai' => 'required|numeric',
        //     'kam_depan' => 'required|numeric',
        //     'kam_belakang' => 'required|numeric',
        //     'harga' => 'required|numeric',
        //     // 'kid' => 'required',
        // ]);

        for ($i = 0; $i < $baris; $i++) {

            // dd($test->internal);
            // dd($test);
            $pid = $train[$i]->id;
            $name = $train[$i]->name;
            $ram  =  (($train[$i]->ram - $min_ram) / ($max_ram - $min_ram));
            $internal  =  (($train[$i]->internal - $min_inter) / ($max_inter - $min_inter));
            $baterai  =  (($train[$i]->baterai - $min_baterai) / ($max_baterai - $min_baterai));
            $kam_depan  =  (($train[$i]->kam_depan - $min_depan) / ($max_depan - $min_depan));
            $kam_belakang  =  (($train[$i]->kam_belakang - $min_belakang) / ($max_belakang - $min_belakang));
            $harga  =  (($train[$i]->harga - $min_harga) / ($max_harga - $min_harga));
            $klas = $train[$i]->kid;

            // dd($pid);


            $isi = Dtnormalize::create([
                // 'pid' => $request->$train('id'),
                // 'name' => $request->name,
                // 'testram' => $request->ram,
                // 'testinternal' => $request->internal,
                // 'testbaterai' => $request->baterai,
                // 'testkam_depan' => $request->kam_depan,
                // 'testkam_belakang' => $request->kam_belakang,
                // 'testharga' => $request->harga,
                // 'kid' => $request->kid,
                // dd($request)

                'pid' => $pid,
                'nram' => $ram,
                'ninternal' => $internal,
                'nbaterai' => $baterai,
                'nkam_depan' => $kam_depan,
                'nkam_belakang' => $kam_belakang,
                'nharga' => $harga,
                'nklas' => $klas,
            ]);
        }
        // dd($isi);
        if ($isi) {
            return redirect()->route('normalisasi')->with(['success' => 'Data berhasil dinormalisasi!']);
        } else {
            return redirect()->route('home')->with(['error' => 'Data gagal dinormalisasi!']);
        }
    }

    public function norm()
    {
        // $test = Datatest::all();
        $dt = Dtnormalize::with(['Datatest'])->get();

        return view('testing.normalize', ['dt' => $dt]);
    }
}
