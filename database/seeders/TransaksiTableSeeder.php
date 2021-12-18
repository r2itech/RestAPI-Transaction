<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenis_barang = [
            [
                'jenis_barang' => 'Konsumsi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jenis_barang' => 'Pembersih',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        $barang = [
            [
                'id_jenis_barang' => 1,
                'nama_barang' => 'Kopi',
                'stok' => 100,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_jenis_barang' => 1,
                'nama_barang' => 'Teh',
                'stok' => 100,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_jenis_barang' => 1,
                'nama_barang' => 'Susu',
                'stok' => 100,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_jenis_barang' => 2,
                'nama_barang' => 'Pasta Gigi',
                'stok' => 100,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_jenis_barang' => 2,
                'nama_barang' => 'Sabun Mandi',
                'stok' => 100,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_jenis_barang' => 2,
                'nama_barang' => 'Sampo',
                'stok' => 100,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        $transaksi = [
            [
                'id_barang' => 1,
                'tanggal_transaksi' => now(),
            ],
            [
                'id_barang' => 1,
                'tanggal_transaksi' => now(),
            ],
            [
                'id_barang' => 1,
                'tanggal_transaksi' => now(),
            ],
            [
                'id_barang' => 2,
                'tanggal_transaksi' => now(),
            ],
            [
                'id_barang' => 3,
                'tanggal_transaksi' => now(),
            ],
            [
                'id_barang' => 4,
                'tanggal_transaksi' => now(),
            ],
            [
                'id_barang' => 4,
                'tanggal_transaksi' => now(),
            ],
            [
                'id_barang' => 5,
                'tanggal_transaksi' => now(),
            ],
            [
                'id_barang' => 6,
                'tanggal_transaksi' => now(),
            ],
        ];

        DB::table('jenis-barang')->insert($jenis_barang);
        DB::table('barang')->insert($barang);
        // DB::table('transaksi')->insert($transaksi);
    }
}
