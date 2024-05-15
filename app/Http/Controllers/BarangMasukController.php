<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use DB;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        $rsetBarangMasuk = BarangMasuk::with('barang')->latest()->paginate(10);
        return view('barangmasuk.index', compact('rsetBarangMasuk'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    
    public function create()
    {
        $abarangmasuk = Barang::all();
        return view('barangmasuk.create',compact('abarangmasuk'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'tgl_masuk'     => 'required',
            'qty_masuk'     => 'required|numeric|min:1',
            'barang_id'     => 'required',
        ]);
        //create post
        BarangMasuk::create([
            'tgl_masuk'        => $request->tgl_masuk,
            'qty_masuk'        => $request->qty_masuk,
            'barang_id'        => $request->barang_id,
        ]);


        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        return view('barangmasuk.show', compact('barangMasuk'));
    }

    public function edit(string $id)
    {
        $abarang = Barang::all();
        $rsetBarangMasuk = BarangMasuk::find($id);
        $selectedBarang = Barang::find($rsetBarangMasuk->barang_id);

        return view('barangmasuk.edit', compact('rsetBarangMasuk', 'abarang', 'selectedBarang'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'tgl_masuk'     => 'required',
            'qty_masuk'     => 'required|numeric|min:1',
            'barang_id'     => 'required',
        ]);

        $rsetBarangMasuk = BarangMasuk::find($id);

            //update post without image
            $rsetBarangMasuk->update([
                'tgl_masuk'        => $request->tgl_masuk,
                'qty_masuk'        => $request->qty_masuk,
                'barang_id'        => $request->barang_id,
            ]);

        // Redirect to the index page with a success message
        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $barangMasuk->delete();

        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}