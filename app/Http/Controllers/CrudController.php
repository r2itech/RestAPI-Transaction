<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\JenisBarang;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\Algoritma;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\Compare;
use Illuminate\Support\Facades\Hash;

class CrudController extends Controller
{

    /**
     * Region AUTH
     */

    public function login(Request $r)
    {
        $user = User::where('email', $r->email)->first();

        if (!$user) {
            return redirect('/login/' .Crypt::encrypt('login'))->with('warning', 'Email not found!');
        }

        if (Auth::attempt($r->only('email', 'password'))) {
            return redirect('/');
        }

        return redirect('/login/' .Crypt::encrypt('login'))->with('warning', 'Password incorrect!!!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login/' .Crypt::encrypt('login'))->with('info', 'You Are Successfully Logged Out');
    }

    /**
     * EndRegion AUTH
     */

    /**
     * Region READ
     */

    public function home(Request $r)
    {
        // $transaksi = DB::statement('select transaksi.tanggal_transaksi, transaksi.id_barang, barang.nama_barang, barang.stok, count(*) as jumlah
        // from transaksi INNER JOIN barang ON transaksi.id_barang = barang.id
        // GROUP BY transaksi.tanggal_transaksi, transaksi.id_barang');
        
        $title = 'Home';
        $transaksi = Transaksi::groupBy('tanggal_transaksi')->groupBy('id_barang')
        ->select('tanggal_transaksi','id_barang', DB::raw('count(*) as jumlah'))
        ->get();

        if($r->ajax()){
            return datatables()->of($transaksi)
            ->addColumn('nama_barang', function($t){
                return $t->barang->nama_barang;
            })
            ->addColumn('jenis_barang', function($t){
                return $t->barang->jenisBarang->jenis_barang;
            })
            ->addColumn('tgl_transaksi', function($t){
                return date('d-m-Y', strtotime($t->tanggal_transaksi));
            })
            ->addColumn('stok', function($t){
                return $t->barang->stok;
            })
            ->rawColumns(['nama_barang','jenis_barang','tgl_transaksi','stok'])
            ->make(true);
        }

        return view('index', compact('title'));
    }

    public function transaksi(Request $r)
    {
        $title = 'Transaksi';
        $transaksi = Transaksi::orderBy('tanggal_transaksi','DESC')->get();

        if($r->ajax()){
            return datatables()->of($transaksi)
            ->addColumn('nama_barang', function($t){
                return $t->barang->nama_barang;
            })
            ->addColumn('jenis_barang', function($t){
                return $t->barang->jenisBarang->jenis_barang;
            })
            ->addColumn('tgl_transaksi', function($t){
                return date('d-m-Y', strtotime($t->tanggal_transaksi));
            })
            ->addColumn('stok', function($t){
                return $t->barang->stok;
            })
            ->addColumn('aksi', function($t){
                return '<a href="transaksi/update/' .Crypt::encrypt('transaksi') .'/' .Crypt::encrypt($t->id) .'/" class="btn btn-info btn-mini"><i class="icon-edit"></i></a>
                        <a href="transaksi/delete/' .Crypt::encrypt($t->id) .'/" onclick="return myFunction();" class="btn btn-danger btn-mini"><i class="icon-trash"></i></a>';
            })
            ->rawColumns(['nama_barang','jenis_barang','tgl_transaksi','stok','aksi'])
            ->toJson();
        }

        return view('admin.transaksi', compact('title'));
    }

    public function barang(Request $r)
    {
        $title = 'Barang';
        $barang = Barang::orderBy('nama_barang','ASC')->get();

        if($r->ajax()){
            return datatables()->of($barang)
            ->addColumn('jenis_barang', function($b){
                return $b->jenisBarang->jenis_barang;
            })
            ->addColumn('aksi', function($b){
                return '<a href="barang/update/' .Crypt::encrypt('barang') .'/' .Crypt::encrypt($b->id) .'/" class="btn btn-info btn-mini"><i class="icon-edit"></i></a>
                        <a href="barang/delete/' .Crypt::encrypt($b->id) .'/" onclick="return myFunction();" class="btn btn-danger btn-mini"><i class="icon-trash"></i></a>';
            })
            ->rawColumns(['jenis_barang','aksi'])
            ->toJson();
        }

        return view('admin.barang', compact('title'));
    }

    public function jenisBarang(Request $r)
    {
        $title = 'Jenis Barang';
        $jenis_barang = JenisBarang::orderBy('jenis_barang','ASC')->get();

        if($r->ajax()){
            return datatables()->of($jenis_barang)
            ->addColumn('aksi', function($b){
                return '<a href="jenisBarang/update/' .Crypt::encrypt('jenisBarang') .'/' .Crypt::encrypt($b->id) .'/" class="btn btn-info btn-mini"><i class="icon-edit"></i></a>
                        <a href="jenisBarang/delete/' .Crypt::encrypt($b->id) .'/" onclick="return myFunction();" class="btn btn-danger btn-mini"><i class="icon-trash"></i></a>';
            })
            ->rawColumns(['aksi'])
            ->toJson();
        }

        return view('admin.jenisBarang', compact('title'));
    }

    public function api(Request $r, $id)
    {
        $title = 'API';
        if(auth()->user()->level == 1){
            $user = User::where('level', 2)->get();
          
            if($r->ajax()){
                return datatables()->of($user)
                ->addColumn('aksi', function($u){
                    return '<a href="user/delete/' .Crypt::encrypt($u->id) .'/" onclick="return myFunction();" class="btn btn-danger btn-mini"><i class="icon-trash"></i></a>';
                })
                ->rawColumns(['aksi'])
                ->toJson();
            }

            return view('admin.user', compact('title'));

        } else{
            $algo = new Algoritma();
            $token = $algo->encrypt(auth()->user()->api_token);
            return view('api', compact('title','token'));
        }
    }

    /**
     * EndRegion READ
     */

    /**
     * Region CREATE
     */

    public function storeTransaksi(Request $r)
    {
        date_default_timezone_set('Asia/Jakarta');

        $barang = Barang::find($r->barang);

        $data = [
            'id_barang' => $r->barang,
            'tanggal_transaksi' => now()
        ];

        $transaksi = Transaksi::create($data);
        $barang->update(['stok' => $barang->stok-1]);

        if($transaksi){
            $data1 = [
                'id_jenis_barang' => $transaksi->barang->id_jenis_barang,
                'id_transaksi' => $transaksi->id,
                'tanggal_transaksi' => $transaksi->tanggal_transaksi
            ];

            Compare::create($data1);
        }

        return redirect('/transaksi')->with('info', 'Data transaksi berhasil ditambahkan');
    }

    public function storeBarang(Request $r)
    {
        $data = [
            'id_jenis_barang' => $r->jenis_barang,
            'nama_barang' => $r->nama_barang,
            'stok' => $r->stok
        ];

        Barang::create($data);
        return redirect('/barang')->with('info', 'Data barang berhasil ditambahkan');
    }

    public function storeJenisBarang(Request $r)
    {
        $r->validate([
            'jenis_barang' => 'unique:jenis-barang'
        ]);
        JenisBarang::create(['jenis_barang' => $r->jenis_barang]);
        return redirect('/jenisBarang')->with('info', 'Data jenis barang berhasil ditambahkan');
    }

    public function storeRegistrasi(Request $r)
    {
        $r->validate([
            'email' => 'unique:users|email:rfc,dns',
            'password' => 'min:5|max:16|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:5|max:16'
        ]);

        $api_token = mt_rand(0, 999999999);

        $data = [
            'name' => $r->name,
            'email' => $r->email,
            'password' => bcrypt($r->password),
            'level' => 2,
            'api_token' => $api_token
        ];

        User::create($data);
        return redirect('/login/' .Crypt::encrypt('login'))->with('info', 'Regsiter Success. Please SignIn!');
    }

    /**
     * EndRegion CREATE
     */

    /**
     * Region UPDATE
     */

    public function updateTransaksi(Request $r, $id)
    {
        $id_transaksi = Crypt::decrypt($id);
        $transaksi = Transaksi::find($id_transaksi);

        $update = $transaksi->update(['id_barang' => $r->barang]);

        if($update){
            $compare = Compare::where('id_transaksi', $transaksi->id)->first();

            $data1 = [
                'id_jenis_barang' => $transaksi->barang->id_jenis_barang
            ];

            $compare->update($data1);
        }

        return redirect('/transaksi')->with('info', 'Data transaksi berhasil diperbaharui');
    }

    public function updateBarang(Request $r, $id)
    {
        $id_barang = Crypt::decrypt($id);
        $barang = Barang::find($id_barang);

        $data = [
            'id_jenis_barang' => $r->jenis_barang,
            'nama_barang' => $r->nama_barang,
            'stok' => $r->stok
        ];

        $barang->update($data);

        return redirect('/barang')->with('info', 'Data barang berhasil diperbaharui');
    }

    public function updateJenisBarang(Request $r, $id)
    {
        $r->validate([
            'jenis_barang' => 'unique:jenis-barang'
        ]);
        
        $id_jenis_barang = Crypt::decrypt($id);
        $jenis_barang = JenisBarang::find($id_jenis_barang);

        $jenis_barang->update(['jenis_barang' => $r->jenis_barang]);

        return redirect('/jenisBarang')->with('info', 'Data jenis barang berhasil diperbaharui');
    }

    public function updateProfil(Request $r, $id, ChangePasswordRequest $request)
    {
        $r->validate([
            'password' => 'min:5|max:16|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:5|max:16'
        ]);

        $old_pass = auth()->user()->password;
        
        if (Hash::check($request->input('old_password'), $old_pass)) {
            $id_user = Crypt::decrypt($id);
            $user = User::find($id_user);
            $user->password = Hash::make($request->input('password'));
            if ($user->save()) {
                return back()->with('info', 'Password Berhasil Diperbaharui');
            }
        } else {
            return back()->with('warning', 'Edit Password Gagal!, Password Sebelumnya Salah');
        }
    }

    /**
     * EndRegion UPDATE
     */

    /**
     * Region DELETE
     */

    public function deleteTransaksi($id)
    {
        $id_transaksi = Crypt::decrypt($id);
        $transaksi = Transaksi::find($id_transaksi);
        $compare = Compare::where('id_transaksi', $transaksi->id)->first();
        $barang = $transaksi->barang->nama_barang;

        $transaksi->delete($transaksi);
        $compare->delete($compare);
        return redirect('/transaksi')->with('info', 'Data transaksi dengan nama barang ' .$barang .' dan id transaksi ' .$id_transaksi .' telah dihapus!');
    }

    public function deleteBarang($id)
    {
        $id_barang = Crypt::decrypt($id);
        $barang = Barang::find($id_barang);
        $nama_barang = $barang->nama_barang;

        $transaksi = Transaksi::where('id_barang', $id_barang)->get();
        if(count($transaksi) > 0){
            return redirect('/barang')->with('warning', 'Data barang dengan nama barang ' .$nama_barang .' dan id barang ' .$id_barang .' tidak bisa dihapus karena data ini berada di data transaksi!');
        }else{
            $barang->delete($barang);
            return redirect('/barang')->with('info', 'Data barang dengan nama barang ' .$nama_barang .' dan id barang ' .$id_barang .' telah dihapus!');
        }
    }

    public function deleteJenisBarang($id)
    {
        $id_jenis_barang = Crypt::decrypt($id);
        $jenis_barang = JenisBarang::find($id_jenis_barang);
        $jenis = $jenis_barang->jenis_barang;

        $barang = Barang::where('id_jenis_barang', $id_jenis_barang)->get();
        if(count($barang) > 0){
            return redirect('/jenisBarang')->with('warning', 'Data jenis barang ' .$jenis .' dengan id jenis barang ' .$id_jenis_barang .' tidak bisa dihapus karena data ini berada di data barang!');
        }else{
            $jenis_barang->delete($jenis_barang);
            return redirect('/jenisBarang')->with('info', 'Data jenis barang ' .$jenis .' dengan id jenis barang ' .$id_jenis_barang .' telah dihapus!');
        }
    }

    public function deleteUser($id)
    {
        $id_user = Crypt::decrypt($id);
        $user = User::find($id_user);
        $nama = $user->name;
        $email = $user->email;

        $user->delete($user);
        return back()->with('info', 'Akun atas nama: ' .$nama .'. Dengan email: ' .$email .' berhasil dihapus');
    }

    /**
     * EndRegion DELETE
     */

    /**
     * Region COMPARE
     */

    public function compare(Request $r)
    {
        date_default_timezone_set('Asia/Jakarta');

        $title = 'Home';
        
        $order = 'ASC';

        $from = $r->from;
        $until = $r->until;
        
        $data = '';
        if($r->from == null){
            $data = Compare::groupBy('id_jenis_barang')
            ->select('id_jenis_barang', DB::raw('count(*) as jumlah'))
            ->orderBy('id_jenis_barang', $order)
            ->get();  
        } else{
            $data = Compare::groupBy('id_jenis_barang')
            ->select('id_jenis_barang','tanggal_transaksi', DB::raw('count(*) as jumlah'))
            ->whereBetween('tanggal_transaksi', [$r->from, $r->until])
            ->orderBy('id_jenis_barang', $order)
            ->get();
        }

        $jenis_barang = JenisBarang::select('id','jenis_barang')
        ->orderBy('id', $order)
        ->get();
        
        // foreach($jenis_barang as $key => $j)
        // {
        //     $jum = (!empty($data[$key])) ? $data[$key]->jumlah : '0';
        //     echo $j->jenis_barang .' : ' .$jum .'<br>';
        // }

        // if($r->ajax()){
        //     return datatables()->of($jenis_barang)
        //     ->addColumn('jumlah', function($t){
        //         $jum = (empty($data[$t])) ? $data[$t]->jumlah : 0;
        //         return $jum;
        //     })
        //     ->rawColumns(['jumlah'])
        //     ->make(true);
        // }

        return view('compare', compact('title','jenis_barang','data','from','until'));
    }

    /**
     * EndRegion COMPARE
     */
}
