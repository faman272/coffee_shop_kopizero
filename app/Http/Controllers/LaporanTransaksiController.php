<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanTransaksiController extends Controller
{
    public function index()
    {
        return view('admin.laporantransaksi.index');
    }

    public function showReport(Request $request)
    {
        $mulai = $request->input('tglm');
        $selesai = $request->input('tgls');
        $semuadata = DB::select('CALL pTanggalLaporan(?, ?)', array($mulai, $selesai));

        // Store the result and dates in the session
        $request->session()->put('report', $semuadata);
        $request->session()->put('mulai', $mulai);
        $request->session()->put('selesai', $selesai);

        return view('admin.laporantransaksi.laporan', ['semuadata' => $semuadata]);
    }

    public function printReport(Request $request)
    {
        // Retrieve the data and dates from the session
        $semuadata = $request->session()->get('report');
        $mulai = $request->session()->get('mulai');
        $selesai = $request->session()->get('selesai');

        // Render the print view
        return view('admin.laporantransaksi.cetaklaporan', ['semuadata' => $semuadata, 'mulai' => $mulai, 'selesai' => $selesai]);
    }



    public function menuHarian()
    {
        $data = DB::table('penjualan_menu_harian')->get()->sortByDesc('jumlah_terjual');
        return view('admin.laporantransaksi.menuharian', ['data' => $data]);
    }


    public function menuMingguan()
    {
        $data = DB::table('penjualan_menu_mingguan')->get()->sortByDesc('jumlah_terjual');
        return view('admin.laporantransaksi.menumingguan', ['data' => $data]);
    }

}