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
        'id_barang',
        'tanggal_transaksi'
    ];

    public function barang()
    {
        return $this->belongsTo('App\Models\Barang', 'id_barang', 'id');
    }

    public function jumlahTransaksi()
    {
        $data = $this->hasOne($this, 'id_barang','id')->selectRaw('id_barang, count(*) as jumlah')->groupBy('id_barang');
        return $data;
    }
}
