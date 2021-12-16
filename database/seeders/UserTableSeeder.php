<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'Dede Rian',
            'email' => 'ryucant7@gmail.com',
            'password' => bcrypt('admin'),
            'level' => '1',
            'api_token' => null,
            'created_at' => now(),
            'updated_at' => now()
        ];

        DB::table('users')->insert($data);

        $this->command->info('Berhasil Menambahkan 1 baris di tabel users');
    }
}
