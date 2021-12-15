<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisBarang;
use App\Models\Barang;
use App\Models\Transaksi;

class CrudController extends Controller
{
    #Region

    public function home()
    {
        $title = 'TestCoding - Home';
        $transaksi = Transaksi::groupBy('id_barang')->get();
        return view('index', compact('title','transaksi'));
    }

    #Endregion
}
