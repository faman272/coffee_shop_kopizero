<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\StokBarang;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Menu;
use App\Models\MetodePembayaran;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $ordersCount = Order::count();
        $categoriesCount = Kategori::count();
        $menusCount = Menu::count();
        $metodePembayaranCount = MetodePembayaran::count();
        $stocksCount = StokBarang::count();


        $orderPending = Order::where('status', 'Pending')->count();
        $orderDiterima = Order::where('status', 'Diterima')->count();
        $orderDiproses = Order::where('status', 'Diproses')->count();


        $salesData = DB::table('orders')
            ->join('pembayarans', 'orders.no_order', '=', 'pembayarans.no_order')
            ->select(DB::raw('DAYNAME(orders.created_at) as day'), DB::raw('SUM(pembayarans.total_pembayaran) as total'))
            ->where('orders.status', 'Diterima')
            ->groupBy('day')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->day => $item->total];
            });



        return view(
            'admin.index',
            compact(
                'usersCount',
                'ordersCount',
                'categoriesCount',
                'menusCount',
                'metodePembayaranCount',
                'orderPending',
                'orderDiterima',
                'orderDiproses',
                'stocksCount',
                'salesData'
            )
        );
    }
}
