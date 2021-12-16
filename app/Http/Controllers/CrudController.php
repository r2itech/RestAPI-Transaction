<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\JenisBarang;
use App\Models\Barang;
use App\Models\Transaksi;

class CrudController extends Controller
{

    /**
     * Region AUTH
     */

    public function login(Request $r)
    {
        $user = User::where('email', $r->email)->first();

        if (!$user) {
            return redirect('/login')->with('warning', 'Email not found!');
        }

        if (Auth::attempt($r->only('email', 'password'))) {
            return redirect('/');
        }

        return redirect('/login')->with('warning', 'Password incorrect!!!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('info', 'You Are Successfully Logged Out');
    }

    /**
     * EndRegion AUTH
     */

    /**
     * Region READ
     */

    public function home()
    {
        $title = 'Home';
        // $transaksi = DB::statement('select transaksi.tanggal_transaksi, transaksi.id_barang, barang.nama_barang, barang.stok, count(*) as jumlah
        // from transaksi INNER JOIN barang ON transaksi.id_barang = barang.id
        // GROUP BY transaksi.tanggal_transaksi, transaksi.id_barang');

        $transaksi = Transaksi::groupBy('tanggal_transaksi')->groupBy('id_barang')
        ->select('tanggal_transaksi','id_barang', DB::raw('count(*) as jumlah'))
        ->get();
        return view('index', compact('title','transaksi'));
    }

    /**
     * EndRegion READ
     */
}
