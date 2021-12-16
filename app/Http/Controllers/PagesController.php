<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CrudController;
use App\Models\Transaksi;
use App\Models\Barang;
use App\Models\JenisBarang;
use Illuminate\Support\Facades\Crypt;

class PagesController extends Controller
{
    public function pages($id)
    {
        $id_page = Crypt::decrypt($id);

        $title = '';
        $url = '';
        switch($id_page){
            case 'login' : 
                $title = 'Login';
                $url = 'login'; break;
            case 'register' : 
                $title = 'Register';
                $url = 'register'; break;
            default :
                $title = '';
                $url = ''; break;
        }

        return view($url, compact('title'));
    }

    public function add($id)
    {
        $id_page = Crypt::decrypt($id);

        $title = '';
        $url = '';
        $data = '';
        switch($id_page){
            case 'transaksi' : 
                $title = 'Transaksi';
                $url = 'admin.createTransaksi';
                $data = Barang::select('id','nama_barang','stok')->where('stok', '>', 0)->orderBy('nama_barang','ASC')->get(); break;
            case 'barang' : 
                $title = 'Barang';
                $url = 'admin.createBarang';
                $data = JenisBarang::select('id','jenis_barang')->orderBy('jenis_barang','ASC')->get(); break;
            case 'jenisBarang' : 
                $title = 'Jenis Barang';
                $url = 'admin.createJenisBarang';
                $data = ''; break;
            default :
                $title = '';
                $url = '';
                $data = ''; break;
        }

        return view($url, compact('title','data'));
    }

    public function edit($id, $id1)
    {
        $id_page = Crypt::decrypt($id);
        $id_data = Crypt::decrypt($id1);

        $title = '';
        $url = '';
        $data = '';
        switch($id_page){
            case 'transaksi' : 
                $title = 'Transaksi';
                $url = 'admin.editTransaksi';
                $data = Barang::select('id','nama_barang','stok')->where('stok', '>', 0)->orderBy('nama_barang','ASC')->get(); 
                $data1 = Transaksi::where('id', $id_data)->first(); break;
            case 'barang' : 
                $title = 'Barang';
                $url = 'admin.editBarang';
                $data = JenisBarang::select('id','jenis_barang')->orderBy('jenis_barang','ASC')->get();
                $data1 = Barang::where('id', $id_data)->first(); break;
            case 'jenisBarang' : 
                $title = 'Jenis Barang';
                $url = 'admin.editJenisBarang';
                $data = '';
                $data1 = JenisBarang::where('id', $id_data)->first(); break;
            default :
                $title = '';
                $url = '';
                $data = ''; break;
        }
        
        return view($url, compact('title','data','data1'));
    }

    public function forbidden()
    {
        $title = 'Forbidden';
        return view('forbidden', compact('title'));
    }
}
