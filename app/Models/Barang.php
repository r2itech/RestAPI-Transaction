<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_jenis_barang',
        'nama_barang',
        'stok'
    ];

    public function jenisBarang()
    {
        return $this->belongsTo('App\Models\JenisBarang', 'id_jenis_barang', 'id');
    }

    public function transaksi()
    {
        return $this->hasMany('App\Models\Transaksi', 'id_barang', 'id');
    }
}
