<?php

namespace App\Http\Controllers;

use App\Models\StokBarang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class DashboardStokBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stokbarangs = StokBarang::all();
        return view('admin.stokbarang.index', compact('stokbarangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
        'nama_barang' => 'required',
        'type_barang' => 'required',
        'volume' => 'required',
        'satuan' => 'required',
        ]);

        StokBarang::create([
            'nama_barang' => $request->nama_barang,
            'type_barang' => $request->type_barang,
            'volume' => $request->volume,
            'satuan' => $request->satuan,
        ]);

        Alert::success('Success', 'Stok Barang Berhasil Ditambahkan');
        return redirect()->route('stokbarang.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(StokBarang $stokBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $stokBarang = StokBarang::find($id);
        return view('admin.stokbarang.edit', compact('stokBarang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $stokBarang = StokBarang::find($id);
        $stokBarang->update([
            'nama_barang' => $request->nama_barang,
            'type_barang' => $request->type_barang,
            'volume' => $request->volume,
            'satuan' => $request->satuan,
        ]);

        Alert::success('Success', 'Stok Barang Berhasil Diupdate');
        return redirect()->route('stokbarang.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $stokBarang = StokBarang::find($id);
        $stokBarang->delete();

        Alert::success('Success', 'Stok Barang Berhasil Dihapus');
        return redirect()->route('stokbarang.index');
    }
}
