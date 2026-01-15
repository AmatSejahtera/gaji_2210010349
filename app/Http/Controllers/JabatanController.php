<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatan = Jabatan::all();
        return view('jabatan.index', compact('jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jabatan.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // memvalidasi inputan
        $this->validate($request, [
            'nama_jabatan'      => 'required|string|max:255',
            'gapok_jabatan'     => 'required|numeric|min:0',
            'tunjangan_jabatan' => 'required|numeric|min:0',
            'uang_makan_perhari' => 'required|numeric|min:0',
        ]);

        // insert data ke database
        Jabatan::create([
            'nama_jabatan'      => $request->nama_jabatan,
            'gapok_jabatan'     => $request->gapok_jabatan,
            'tunjangan_jabatan' => $request->tunjangan_jabatan,
            'uang_makan_perhari' => $request->uang_makan_perhari,
        ]);

        Alert::success('Sukses', 'Berhasil Menambahkan Jabatan Baru');
        return redirect()->route('jabatan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        return view('jabatan.edit', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        // memvalidasi inputan
        $this->validate($request, [
            'nama_jabatan'      => 'required|string|max:255',
            'gapok_jabatan'     => 'required|numeric|min:0',
            'tunjangan_jabatan' => 'required|numeric|min:0',
            'uang_makan_perhari' => 'required|numeric|min:0',
        ]);

        // update data ke database
        $jabatan->update([
            'nama_jabatan'      => $request->nama_jabatan,
            'gapok_jabatan'     => $request->gapok_jabatan,
            'tunjangan_jabatan' => $request->tunjangan_jabatan,
            'uang_makan_perhari' => $request->uang_makan_perhari,
        ]);

        Alert::success('Sukses', 'Berhasil Mengupdate Jabatan');
        return redirect()->route('jabatan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        $jabatan->delete();
        Alert::success('Sukses', 'Berhasil Menghapus Jabatan');
        return redirect()->route('jabatan.index');
    }

    public function printPdf()
{
    $jabatan = Jabatan::all();

    $pdf = PDF::loadView('masterdata.jabatan._pdf', compact('jabatan'));
    $pdf->setPaper('A4', 'landscape');
    return $pdf->stream('Data Gaji.pdf', array("Attachment" => false));
}
}
