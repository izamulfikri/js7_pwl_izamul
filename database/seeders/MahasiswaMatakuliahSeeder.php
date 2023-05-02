<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class MahasiswaMatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mhsmatakuliah = [
            [
                'Nim' =>2142720171,
                'matakuliah_id' =>1,
                'nilai' => 'A',
            ],
            [
                'Nim' =>2142720172,
                'matakuliah_id' =>3,
                'nilai' => 'A',
            ],
        ];

        DB::table('mahasiswa_matakuliah')->insert($mhsmatakuliah);
    }
}
