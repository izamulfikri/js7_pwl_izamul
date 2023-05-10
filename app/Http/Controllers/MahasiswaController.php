<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\kelas;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use PDF;


class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $mahasiswas = Mahasiswa::paginate(5); // Mengambil semua isi tabel
        // $posts = Mahasiswa::orderBy('NIM', 'desc')->paginate(6);
        // return view('mahasiswas.index', compact('mahasiswas'))->with('i', (request()->input('page', 1) - 1) * 5);

        //yang semula Mahasiswa::all, diubah menjadi with() yang menyatakan relasi

        $mahasiswas = Mahasiswa::with('kelas');
        $paginate = Mahasiswa::orderBy('Nim', 'asc')->paginate(5);
        return view('mahasiswas.index', ['mahasiswas' => $mahasiswas, 'paginate' => $paginate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = kelas::all(); //mendapatkan data dari tabel kelas
        return view('mahasiswas.create', ['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'foto' => 'required|image|max:2048',
            'kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
            'Tanggal_lahir' => 'required',
        ]);
        // // fungsi eloquent untuk menambah data
        // Mahasiswa::create($request->all());

        $imageName = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('storage'), $imageName);

        $mahasiswas = new Mahasiswa;
        $mahasiswas->Nim = $request->get('Nim');
        $mahasiswas->Nama = $request->get('Nama');
        $mahasiswas->foto = $imageName;
        $mahasiswas->Tanggal_lahir = $request->get('Tanggal_lahir');
        $mahasiswas->Jurusan = $request->get('Jurusan');
        $mahasiswas->Email = $request->get('Email');
        $mahasiswas->No_Handphone = $request->get('No_Handphone');

        $kelas = new Kelas;
        $kelas->id = $request->get('kelas');

        $mahasiswas->kelas()->associate($kelas);
        $mahasiswas->save();

        // jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        // menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Mahasiswa = Mahasiswa::find($nim);
        return view('mahasiswas.detail', compact('Mahasiswa'));
    }

    public function detailnilai($nim)
    {
        // menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Mahasiswa = Mahasiswa::with('matakulias')->where('Nim', $nim)->first();
        $nilai = DB::table('mahasiswa_matakuliah')
            ->join('matakuliah', 'matakuliah.id', '=', 'mahasiswa_matakuliah.matakuliah_id')
            ->where('mahasiswa_matakuliah.Nim', $nim)
            ->select('nilai')
            ->get();
        return view('mahasiswas.nilai', ['Mahasiswa' => $Mahasiswa, 'nilai' => $nilai]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nim)
    {
        // menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::find($nim);
        $kelas = kelas::all();
        return view('mahasiswas.edit', compact('Mahasiswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $nim)
    {
        // melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'foto' => 'required|image|max:2048',
            'kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
            'Tanggal_lahir' => 'required',
        ]);
        // // fungsi eloquent untuyk mengupdate data inputan kita
        // Mahasiswa::find($nim)->update($request->all());

        // Mahasiswa::find($nim)->update($request->all());
        $mahasiswas = Mahasiswa::with('kelas')->where('Nim', $nim)->first();
        $mahasiswas->Nim = $request->get('Nim');
        $mahasiswas->Nama = $request->get('Nama');
        $mahasiswas->Tanggal_lahir = $request->get('Tanggal_lahir');
        $mahasiswas->Jurusan = $request->get('Jurusan');
        $mahasiswas->Email = $request->get('Email');
        $mahasiswas->No_Handphone = $request->get('No_Handphone');
        $mahasiswas->save();

        if ($request->file('foto')) {
            // hapus foto lama jika ada foto baru yang diupload
            if ($mahasiswas->foto && file_exists(storage_path('app/public/' . $mahasiswas->foto))) {
                \Storage::delete('public/' . $mahasiswas->foto);
            }
            // simpan foto baru ke direktori penyimpanan
            $file = $request->file('foto');
            $nama_file = $file->getClientOriginalName();
            $file->storeAs('public/foto', $nama_file);
            // simpan nama file foto ke dalam kolom 'foto' pada tabel 'mahasiswas'
            $mahasiswas->foto = $nama_file;
        }
        $image_name = $request->file('foto')->store('images', 'public');
        $mahasiswas->foto = $image_name;

        $kelas = new Kelas;
        $kelas->id = $request->get('kelas');

        $mahasiswas->kelas()->associate($kelas);
        $mahasiswas->save();


        // jika data berhasil diupdate, akan kembali ke ahalaman utama
        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nim)
    {
        // fungsi eloquent untuk menghapus data
        Mahasiswa::find($nim)->delete();
        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function find(Request $request)
    {
        $findMhs = $request->findMhs;
        $mahasiswas = Mahasiswa::where('nama', 'like', '%' . $findMhs . '%')->paginate(5);
        return view('mahasiswas.index', compact('mahasiswas'));
    }

    public function exportPDF($nim)
    {
        $mahasiswas = Mahasiswa::with('matakulias')->where('Nim', $nim)->first();
        $nilai = DB::table('mahasiswa_matakuliah')
            ->join('matakuliah', 'matakuliah.id', '=', 'mahasiswa_matakuliah.matakuliah_id')
            ->where('mahasiswa_matakuliah.Nim', $nim)
            ->select('nilai')
            ->get();
        $pdf = PDF::loadView('mahasiswas.nilai_pdf', ['mahasiswas' => $mahasiswas, 'nilai' => $nilai]);
        return $pdf->download('KHS-' . $mahasiswas->Nama . '.pdf');
    }
}
