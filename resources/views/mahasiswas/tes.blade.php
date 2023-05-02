@extends('mahasiswas.layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <table class="table table-bordered">
            <tr>
                <th>Nim</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($studentList as $Mahasiswa)
            <tr>

                <td>{{ $Mahasiswa->Nim }}</td>
                <td>{{ $Mahasiswa->kelas->nama_kelas }}</td>
                <td>
                    @foreach ($Mahasiswa->matakulias as $item)
                        - {{$item->nama_matkul}} <br>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection