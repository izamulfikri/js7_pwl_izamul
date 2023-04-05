<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'Nim' => 2142720171,
                'Nama' => 'Mohammad Izamul Fikri Fahmi',
                'Kelas' => 'TI-2F',
                'Jurusan' => 'Teknik Informatika',
                'No_Handphone' => '08899223232',
                'Email' => 'izam@gmail.com',
                'Tanggal_lahir' => '12-04-2003'
            ],
            [
                'Nim' => 2142720172,
                'Nama' => 'Muhammad Dzaka Murran Rusid',
                'Kelas' => 'TI-2F',
                'Jurusan' => 'Teknik Informatika',
                'No_Handphone' => '08812512511',
                'Email' => 'dzaka@gmail.com',
                'Tanggal_lahir' => '20-01-2003'
            ],
            [
                'Nim' => 2142720173,
                'Nama' => 'Bagus Dwi Putranto',
                'Kelas' => 'TI-2F',
                'Jurusan' => 'Teknik Informatika',
                'No_Handphone' => '01511622244',
                'Email' => 'bagus@gmail.com',
                'Tanggal_lahir' => '06-06-2003'
            ],
            [
                'Nim' => 2142720174,
                'Nama' => 'Faiz Atha Raditya',
                'Kelas' => 'TI-2F',
                'Jurusan' => 'Teknik Informatika',
                'No_Handphone' => '08224222662',
                'Email' => 'faiz@gmail.com',
                'Tanggal_lahir' => '12-12-2003'
            ],
            [
                'Nim' => 2142720175,
                'Nama' => 'Ghulam Komarudin',
                'Kelas' => 'TI-3F',
                'Jurusan' => 'Teknik Informatika',
                'No_Handphone' => '08896651512',
                'Email' => 'ghulamk@gmail.com',
                'Tanggal_lahir' => '15-04-2004'
            ],
            [
                'Nim' => 2142720176,
                'Nama' => 'Alvian Nur Firdaus',
                'Kelas' => 'TI-2F',
                'Jurusan' => 'Teknik Informatika',
                'No_Handphone' => '08794232312',
                'Email' => 'alvian@gmail.com',
                'Tanggal_lahir' => '02-06-2003'
            ],
            [
                'Nim' => 2142720177,
                'Nama' => 'Ega Rama Fernanda',
                'Kelas' => 'TI-2F',
                'Jurusan' => 'Teknik Informatika',
                'No_Handphone' => '08899261632',
                'Email' => 'ega@gmail.com',
                'Tanggal_lahir' => '12-06-2003'
            ],
            [
                'Nim' => 2142720178,
                'Nama' => 'Hakan Alif Pramudya',
                'Kelas' => 'TI-2F',
                'Jurusan' => 'Teknik Informatika',
                'No_Handphone' => '08779223232',
                'Email' => 'hakan@gmail.com',
                'Tanggal_lahir' => '17-08-2003'
            ],
            [
                'Nim' => 2142720179,
                'Nama' => 'Ibnu Hajar Askholani',
                'Kelas' => 'TI-2F',
                'Jurusan' => 'Teknik Informatika',
                'No_Handphone' => '08899223552',
                'Email' => 'ibnu@gmail.com',
                'Tanggal_lahir' => '25-01-2003'
            ],
            [
                'Nim' => 2142720170,
                'Nama' => 'Naresh Pratista',
                'Kelas' => 'TI-2F',
                'Jurusan' => 'Teknik Informatika',
                'No_Handphone' => '08884323232',
                'Email' => 'naresh@gmail.com',
                'Tanggal_lahir' => '10-04-2003'
            ],
            [
                'Nim' => 2142720170,
                'Nama' => 'Naresh Pratista',
                'Kelas' => 'TI-2F',
                'Jurusan' => 'Teknik Informatika',
                'No_Handphone' => '08884323232',
                'Email' => 'naresh@gmail.com',
                'Tanggal_lahir' => '10-04-2003'
            ]
        ];
        Mahasiswa::insert($data);
    }
}
