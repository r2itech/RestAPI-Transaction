<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compare extends Model
{
    use HasFactory;

    protected $table = 'compare';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_jenis_barang',
        'id_transaksi',
        'tanggal_transaksi'
    ];

    public function jenisBarang()
    {
        return $this->belongsTo('App\Models\JenisBarang', 'id_jenis_barang', 'id');
    }

    public function transaksi()
    {
        return $this->belongsTo('App\Models\Transaksi', 'id_transaksi', 'id');
    }
}
