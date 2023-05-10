<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Mahasiswa as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model; //Model Eloquent

class Mahasiswa extends Model //Definisi Model
{
    protected $table = "mahasiswas"; // Eloquent akan membuat model mahasiswa menyimpan record di tabel mahasiswas
    public $timestamps = false;
    protected $primaryKey = 'Nim'; // Memanggil isi DB Dengan primarykey
    /** 
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Nim',
        'Nama',
        'foto',
        'kelas_id',
        'Jurusan',
        'Email',
        'No_Handphone',
        'Tanggal_lahir',
    ];

    public function kelas()
    {
        return $this->belongsTo(kelas::class);
    }

    public function matakulias()
    {
        return $this->belongsToMany(matakuliah::class,'mahasiswa_matakuliah','Nim','matakuliah_id');
    }

};
?>