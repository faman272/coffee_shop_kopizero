<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\DetailOrder;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()
            ->with('detail_orders', 'pembayarans')
            ->get()
            ->sortByDesc('created_at');

        return view('history', compact('orders'));
    }

    public function detail($id)
    {
        $order = Order::with('detail_orders', 'pembayarans') // Load the detail_orders and pembayaran relationships
            ->where('no_order', $id) // Filter by the order number
            ->firstOrFail(); // Get the order or fail if it doesn't exist

        return view('detailhistory', compact('order'));
    }

}
