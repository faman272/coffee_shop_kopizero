<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\Menu;
use App\Models\Order;
use App\Models\DetailOrder;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        // Fetch the cart data for the authenticated user
        $cartItems = Auth::user()->orders()
            ->where('status', 'In Cart')
            ->with('detail_orders.menus') // Load the menu relationship
            ->get();

        // Calculate the total
        $total = $cartItems->sum(function ($order) {
            return $order->detail_orders->sum('subtotal');
        });

        // Pass the data to the view
        return view('cart', ['cartItems' => $cartItems, 'total' => $total]);
    }

    public function generateNoOrder()
    {
        return str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    public function create(Request $request, $id)
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            Alert::toast('Silakan daftar atau login terlebih dahulu', 'warning');
            return redirect()->route('register'); // Redirect to the login page
        }

        // Check if there are any orders with a status of 'Pending'
        $processingOrder = Auth::user()->orders()
            ->where('status', 'Pending')
            ->first();

        if ($processingOrder) {
            Alert::toast('Anda tidak dapat menambahkan menu ke keranjang, ada transaksi yang sedang diproses', 'warning');
            return redirect()->route('home'); // Redirect to the home page
        }

        $menu = Menu::where('id_menu', $id)->first();

        // Check if an Order already exists for the user
        $existingOrder = Auth::user()->orders()
            ->where('status', 'In Cart')
            ->first();

        $user = User::find(Auth::user()->id);

        if (!$user) {
            Alert::toast('User tidak ditemukan', 'error');
            return redirect()->route('home'); // Redirect to the home page
        }

        if ($existingOrder) {
            $no_order = $existingOrder->no_order;
        } else {
            $no_order = $this->generateNoOrder();
            $order = new Order;
            $order->no_order = $no_order;
            $order->user_id = Auth::user()->id;
            $order->tgl_order = date('Y-m-d H:i:s');
            $order->status = 'In Cart';
            $order->save();
        }

        $existingCartItem = Auth::user()->orders()
            ->where('no_order', $no_order)
            ->whereHas('detail_orders', function ($query) use ($menu, $request) {
                $query->where('menu_id', $menu->id_menu)
                    ->where('jenis_harga', $request->jenis_harga);
            })
            ->first();

        if ($existingCartItem) {
            // Fetch the DetailOrder object
            $detailOrder = $existingCartItem->detail_orders()
                ->where('menu_id', $menu->id_menu)
                ->where('jenis_harga', $request->jenis_harga)
                ->first();

            if ($detailOrder) {
                // If the menu with the same jenis_harga is already in the cart, update quantity and subtotal
                $detailOrder->qty += $request->quantity;
                $detailOrder->subtotal = $detailOrder->qty * $detailOrder->harga;
                $detailOrder->save();
            }
        } else {
            // If the menu with the same jenis_harga is not in the cart, create a new cart item
            $detailOrder = new DetailOrder;

            $detailOrder->no_order = $no_order;
            $detailOrder->menu_id = $menu->id_menu;
            $detailOrder->qty = $request->quantity;
            $detailOrder->jenis_harga = $request->jenis_harga;
            // Determine the price based on the selected jenis_harga
            $detailOrder->harga = ($detailOrder->jenis_harga == 'hot') ? $menu->H_Hot : (($detailOrder->jenis_harga == 'ice') ? $menu->H_Ice : 0);
            $detailOrder->subtotal = $detailOrder->qty * $detailOrder->harga;
            $detailOrder->save();
            Alert::toast('Ditambahkan Ke Keranjang', 'success');
        }

        return redirect("/cart");
    }

    public function show($id)
    {
        $cartItem = DetailOrder::where("menu_id", $id)->first();
        return view("editcart", compact("cartItem"));
    }

    public function update(Request $request, $menu_id)
    {
        // dd($request->all());

        $cartItem = DetailOrder::where("menu_id", $menu_id)->first();
        if ($cartItem) {
            $harga = ($request->jenis_harga == 'hot') ? $cartItem->menus->H_Hot : (($request->jenis_harga == 'ice') ? $cartItem->menus->H_Ice : 0);
            $cartItem->update([
                'qty' => $request->quantity,
                'jenis_harga' => $request->jenis_harga,
                'harga' => $harga,
                'subtotal' => $request->quantity * $harga,
            ]);

            Alert::toast('Berhasil di update', 'success');
            return redirect('/cart');

        } else {
            Alert::toast('Gagal', 'error');
            return redirect("/cart");
        }
    }

    public function delete($menu_id, $no_order)
    {

        DB::table('detail_orders')
            ->where('menu_id', $menu_id)
            ->where('no_order', $no_order)
            ->delete();

        Alert::toast('Berhasil di hapus', 'success');
        return redirect('/cart');
    }
}
