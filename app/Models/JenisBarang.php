<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;
use Hamcrest\Core\HasToString;

class JenisBarang extends Model
{
    use HasFactory;

    protected $table = 'jenis-barang';
    protected $primaryKey = 'id';

    protected $fillable = [
        'jenis_barang'
    ];

    public function barang()
    {
        return $this->hasMany('App\Models\Barang', 'id_jenis_barang', 'id');
    }

    public function compare()
    {
        return $this->hasMany('App\Models\Compare', 'id_jenis_barang', 'id');
    }
}
