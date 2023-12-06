<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use App\Models\DetailOrder;
use App\Models\Pembayaran;
use App\Models\Notification;

use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


use App\Jobs\CancelOrderJob;
use Illuminate\Support\Facades\Queue;

use App\Events\UserOrder;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            // Handle the case where the user is not authenticated
            return redirect()->route('login');
        }

        // Check if the user's cart is empty
        if ($user->carts->isEmpty()) {
            Alert::warning('Keranjang anda kosong');
            return redirect('/');
        }

        // Get the user's orders with a status of "Menunggu Pembayaran"
        $orders = $user->orders()->where('status', 'Menunggu Pembayaran')->get();

        $total = 0;
        foreach ($orders as $order) {
            $detailOrders = $order->detail_orders;
            foreach ($detailOrders as $detailOrder) {
                $total += $detailOrder->subtotal;
            }
        }

        // Pass the data to the view
        return view('checkout', [
            'user' => $user,
            'orders' => $orders,
            'total' => $total
        ]);
    }

    public function generateNoOrder()
    {
        return rand(100000, 999999);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $cartItems = $user->carts;

        // Check if cart is empty
        if ($cartItems->isEmpty()) {
            Alert::warning('Keranjang anda kosong');
            return redirect('/');
        }

        // Check if there are any pending transactions
        $pendingOrder = $user->orders()->where('status', 'Menunggu Pembayaran')->first();

        if ($pendingOrder) {
            // For each cart item, check if a DetailOrder already exists
            foreach ($cartItems as $cartItem) {
                $detailOrder = DetailOrder::where('no_order', $pendingOrder->no_order)
                    ->where('menu_id', $cartItem->menu_id)
                    ->first();

                // If a DetailOrder does not exist, create a new one
                if (!$detailOrder) {
                    $detailOrder = new DetailOrder;
                    $detailOrder->no_order = $pendingOrder->no_order;
                    $detailOrder->menu_id = $cartItem->menu_id;
                }

                // Update the DetailOrder
                $detailOrder->qty = $cartItem->qty;
                $detailOrder->harga = $cartItem->harga;
                $detailOrder->jenis_harga = $cartItem->jenis_harga;
                $detailOrder->subtotal = $cartItem->subtotal;
                $detailOrder->save();
            }

            // Delete any DetailOrder that does not correspond to an item in the cart
            DetailOrder::where('no_order', $pendingOrder->no_order)
                ->whereNotIn('menu_id', $cartItems->pluck('menu_id'))
                ->delete();

            return redirect("/checkout");
        }

        // Create a new Order instance
        $no_order = $this->generateNoOrder();
        $order = new Order;
        $order->no_order = $no_order;
        $order->user_id = $user->id;
        $order->tgl_order = now(); // Set the order date to the current date and time
        $order->save();

        // For each cart item, create a new DetailOrder instance
        foreach ($cartItems as $cartItem) {
            $detailOrder = new DetailOrder;
            $detailOrder->no_order = $no_order;
            $detailOrder->menu_id = $cartItem->menu_id;
            $detailOrder->qty = $cartItem->qty;
            $detailOrder->harga = $cartItem->harga;
            $detailOrder->jenis_harga = $cartItem->jenis_harga;
            $detailOrder->subtotal = $cartItem->subtotal;
            $detailOrder->save();
        }

        


        return redirect("/checkout");
    }



    public function transaksi(Request $request, $no_order)
    {

        if ($request->input('metode_pembayaran') == null) {
            Alert::warning('Silahkan pilih metode pembayaran');
            return redirect()->back();
        }
        // Call the fHitungNomorMeja function
        $jumlahNoMeja = DB::select("SELECT fHitungNomorMeja(?) AS order_count", [$request->nomor_meja])[0]->order_count;

        // Check if the table number is already in use
        if ($jumlahNoMeja > 0 && $request->nomor_meja != null) {
            Alert::warning('Maaf, Nomor meja sudah digunakan silahkan pilih nomor meja lain');
            return redirect()->back();
        }

        Order::where('no_order', $no_order)->update([
            "nomor_meja" => $request->nomor_meja,
            "catatan" => $request->catatan,
            "metode_pembayaran_id" => $request->metode_pembayaran
        ]);

        Pembayaran::create([
            "no_order" => $no_order,
            "total_pembayaran" => $request->total
        ]);       

        



        // Get the authenticated user
        $user = Auth::user();

        // Delete the cart items
        $user->carts()->delete();

        Alert::toast('Silahkan lakukan pembayaran', 'warning');
        return redirect()->route('pembayaran', ['no_order' => $no_order]);
    }

    public function pembayaran($no_order)
    {


        if (!session()->has('start_time')) {
            session(['start_time' => time()]);
        }

        $order = Auth::user()->orders()
            ->where('no_order', $no_order)
            ->where('status', 'Menunggu Pembayaran')
            ->first();

        // dd($order);


        $total = $order->detail_orders->sum('subtotal');

        return view('pembayaran', compact('order', 'total'));
    }

    public function bayar(Request $request, $no_order)
    {
        // dd($request->all());

        session()->forget('start_time');

        $orders = Auth::user()->orders()
            ->where('no_order', $no_order)
            ->where('status', 'Menunggu Pembayaran')
            ->with('detail_orders.menus')
            ->get();

        $userName = Auth::user()->name;


        if ($request->input('cash') === 'Pending') {
            Order::where('no_order', $no_order)->update([
                "status" => "Pending",
            ]);

            $menuNames = [];
            foreach ($orders as $order) {
                foreach ($order->detail_orders as $detail_order) {
                    $menuNames[] = $detail_order->menus->nama_menu . " (" . $detail_order->jenis_harga . ")";
                }
            }
            $message = "{$userName} has ordered " . implode(', ', $menuNames) . "!";
            event(new UserOrder($message));

            // Insert into notifications table
            Notification::create([
                'no_order' => $no_order,
                'message' => $message,
                'is_read' => false,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            Alert::success('Pembayaran berhasil silahkan bayar di kasir');
            return redirect()->route('home');
        }

        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $bukti = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/bukti_pembayaran', $filename);
            $bukti = $filename;
        }

        Pembayaran::where('no_order', $no_order)->update([
            "bukti_pembayaran" => $bukti
        ]);

        Order::where('no_order', $no_order)->update([
            "status" => "Pending",
        ]);

        $menuNames = [];
        foreach ($orders as $order) {
            foreach ($order->detail_orders as $detail_order) {
                $menuNames[] = $detail_order->menus->nama_menu . " (" . $detail_order->jenis_harga . ")";
            }
        }
        $message = "{$userName} has ordered " . implode(', ', $menuNames) . "!";
        event(new UserOrder($message));

        // Insert into notifications table
        Notification::create([
            'no_order' => $no_order,
            'message' => $message,
            'is_read' => false,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Alert::success('Pembayaran sedang diproses silahkan menunggu');
        return redirect()->route('home');
    }

    public function cancel(Request $request, $no_order)
    {
        session()->forget('start_time');

        $order = Auth::user()->orders()->where('no_order', $no_order)->first();

        if (!$order) {
            Alert::warning('Order not found');
            return redirect()->route('home');
        }

        $order->status = $request->status_cancel;
        $order->save();

        Alert::success('Order berhasil dibatalkan');
        return redirect()->route('home');
    }



}
