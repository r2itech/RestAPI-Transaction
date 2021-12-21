<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_jenis_barang',
        'id_barang',
        'tanggal_transaksi'
    ];

    public function barang()
    {
        return $this->belongsTo('App\Models\Barang', 'id_barang', 'id');
    }

    public function jenisBarang()
    {
        return $this->belongsTo('App\Models\JenisBarang', 'id_jenis_barang', 'id');
    }
}
