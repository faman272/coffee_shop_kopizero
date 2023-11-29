<?php

namespace App\Http\Controllers;

use App\Models\MetodePembayaran;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;


class DashboardMetodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metode_pembayarans = MetodePembayaran::all();

        return view('admin.metode_pembayaran.index', compact('metode_pembayarans'));
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
        $metode = new MetodePembayaran;

        $metode->nama_metode = $request->input('nama_metode');
        $metode->norek = $request->input('norek');
        $metode->atas_nama = $request->input('atas_nama');
        $metode->logo = $request->input('logo');

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/metode', $filename);
            $metode->logo = $filename;
        }

        $metode->save();

        Alert::success('Success', 'Metode Pembayaran Berhasil Ditambahkan');
        return redirect()->route('metode_pembayaran.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(MetodePembayaran $metodePembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MetodePembayaran $metodePembayaran)
    {
        return view('admin.metode_pembayaran.edit', compact('metodePembayaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MetodePembayaran $metodePembayaran)
    {

        // dd($request->all());


        $metodePembayaran->update([
            'nama_metode' => $request->nama_metode,
            'norek' => $request->norek,
            'atas_nama' => $request->atas_nama,
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/metode', $filename);
            $metodePembayaran->logo = $filename;
            $metodePembayaran->save();
        }

        Alert::success('Success', 'Metode Pembayaran Berhasil Diupdate');
        return redirect()->route('metode_pembayaran.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MetodePembayaran $metodePembayaran)
    {
        $metodePembayaran->delete();

        Alert::success('Success', 'Metode Pembayaran Berhasil Dihapus');
        return redirect()->route('metode_pembayaran.index');
    }
}
