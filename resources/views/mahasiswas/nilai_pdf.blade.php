@extends('mahasiswas.layout')
@section('content')
<!DOCTYPE html>
<html>
    <head>
        <title>KHS Mahasiswa</title>
    </head>
    <body>
        <div class="row">
            <div class="col-lg-12 margin-tb" style="justify-content: center; align-items: center; text-align: center;">
            <div class="pull-left mt-2">
                <h4>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h4>
                <h5 style="margin-top: 30px">KARTU HASIL STUDI (KHS)</h5>
            </div>
        </div>
        <div class="left-text" style="margin-top: 40px">
            <p><b>Nama : </b>{{$mahasiswas->Nama}}</p>
            <p><b>NIM : </b>{{$mahasiswas->Nim}}</p>
            <p><b>Kelas : </b>{{$mahasiswas->kelas->nama_kelas}}</p>
        </div>
        <table class="table table-bordered">
            <tr>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Semester</th>
                <th>Nilai</th>
            </tr>
            @foreach ($mahasiswas->matakulias as $mhs)
                <tr>
                    <td>{{ $mhs->nama_matkul }}</td>
                    <td>{{ $mhs->sks }}</td>
                    <td>{{ $mhs->semester }}</td>
                    @php
                        $n = $nilai->where('Nim', $mhs->Nim)->first();
                    @endphp
                    <td>
                        @if($nilai)
                            {{ $n->nilai }}
                        @else
                            Nilai belum diisi
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </body>
</html>
@endsection