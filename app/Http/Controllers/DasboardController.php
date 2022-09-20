<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DasboardController extends Controller
{

    public function search(Request $request)
    {
        dd($request->all());
        // "ram" => "8"
        // "internal" => "128 GB"
        // "kam_bel" => "13"
        // "kam_dep" => "13"
        // "baterai" => "5000"
        // "klasifikasi" => "Flagship"

        return view('admin.isi');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function profil()
    // {
    //     $user = Auth::user()->id;
    //     $auth = User::where('id', $user)->get();

    //     return view('admin.profil', ['auth' => $auth]);
    // }
    public function profil($id)
    {
        $user = User::find($id);

        if (empty($user)) {
            return redirect()->route('home');
        }

        return view('admin.profil', ['users' => $user]);
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);

        if (empty($user)) {
            return redirect()->route('profil');
        }

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        if ($user) {
            return redirect()->route('profil', ['id' => Auth::user()->id])->with(['success' => 'Data berhasil diedit!']);
        } else {
            return redirect()->route('profil', ['id' => Auth::user()->id])->with(['error' => 'Data gagal diedit!']);
        }
    }

    public function changePass(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        $newpass = User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        if ($newpass) {
            return redirect()->route('profil', ['id' => Auth::user()->id])->with(['success' => 'Password berhasil diubah!']);
        } else {
            return redirect()->route('profil', ['id' => Auth::user()->id])->with(['error' => 'Password gagall diubah!']);
        }
    }
}
