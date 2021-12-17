<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Algoritma;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\User;

use function PHPUnit\Framework\isEmpty;

class ApiTransaksiController extends Controller {
    public function getTransaksi(Request $r)
    {
        $algo = new Algoritma();
        $api_token = $algo->decrypt($r->token);
        
        $users = User::where('api_token', $api_token)->first();

        if($users != null){
            $transaksi = Transaksi::orderBy('tanggal_transaksi','DESC')->get();
            
            $records = [];
            foreach($transaksi as $row){
                $records[] = [
                    'nama_barang' => $row->barang->nama_barang,
                    'jenis_barang' => $row->barang->jenisBarang->jenis_barang,
                    'tanggal_transaksi' => date('d-m-Y', strtotime($row->tanggal_transaksi)),
                    'stok' => $row->barang->stok
                ];
            }

            $user = [
                'nama' => $users->name,
                'email' => $users->email
            ];

            return $this->successJSON([
                'user' => $user,
                'transaksi' => $records
            ]);
        }
        else{
            return $this->errorJSON('Who are you? You not allowed to get data from here!');
        }
    }

    public function getBarang(Request $r)
    {
        $algo = new Algoritma();
        $api_token = $algo->decrypt($r->token);
        
        $users = User::where('api_token', $api_token)->first();

        if($users != null){
            $barang = Barang::orderBy('nama_barang','ASC')->get();
            
            $records = [];
            foreach($barang as $row){
                $records[] = [
                    'nama_barang' => $row->nama_barang,
                    'jenis_barang' => $row->jenisBarang->jenis_barang,
                    'stok' => $row->stok
                ];
            }

            $user = [
                'nama' => $users->name,
                'email' => $users->email
            ];

            return $this->successJSON([
                'user' => $user,
                'barang' => $records
            ]);
        }
        else{
            return $this->errorJSON('Who are you? You not allowed to get data from here!');
        }
    }

    public function getJenisBarang(Request $r)
    {
        $algo = new Algoritma();
        $api_token = $algo->decrypt($r->token);
        
        $users = User::where('api_token', $api_token)->first();

        if($users != null){
            $jenis_barang = JenisBarang::orderBy('jenis_barang','ASC')->get();
            
            $records = [];
            foreach($jenis_barang as $row){
                $records[] = [
                    'jenis_barang' => $row->jenis_barang,
                ];
            }

            $user = [
                'nama' => $users->name,
                'email' => $users->email
            ];

            return $this->successJSON([
                'user' => $user,
                'jenisBarang' => $records
            ]);
        }
        else{
            return $this->errorJSON('Who are you? You not allowed to get data from here!');
        }
    }
}