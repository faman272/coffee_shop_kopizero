<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use App\Events\UserNotif;

class DashboardPesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('status', '!=', 'Menunggu Pembayaran')->orderBy('created_at', 'desc')->get();

        return view('admin.pesanan.index', compact('orders'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order = Order::with('detail_orders.menus')->find($id);
        return view('admin.pesanan.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $userId = $request->input('user_id');


        if ($request->input('status') === 'Diproses') {

            $order = Order::find($id);
            $order->status = $request->status;
            $order->save();

            $pesan = "Pesanan dengan nomor order " . $order->no_order . " telah diproses";
            event(new UserNotif($userId, $pesan));

            UserNotification::create([
                'user_id' => $userId,
                'no_order' => $order->no_order,
                'message' => $pesan
            ]);

            Alert::success('Pesanan', 'Diproses');
            return redirect('/dashboard/pesanan');

        } else {

            Order::where('no_order', $id)->update([
                "status" => "Diterima",
            ]);

            Alert::success('Pesanan', 'Diterima');
            return redirect('/dashboard/pesanan');

        }





    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
