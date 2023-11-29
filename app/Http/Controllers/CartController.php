<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Cart;
use App\Models\Menu;

use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {


        // Retrieve the user's cart items
        $cartItems = Auth::user()->carts;

        $total = $cartItems->sum('subtotal');
        // Pass the data to the view
        return view('cart', compact('cartItems', 'total'));
    }


    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if there are any pending transactions
        $pendingOrder = $user->orders()->whereIn('status', ['Pending', 'Diproses'])->first();
        if ($pendingOrder) {
            Alert::warning('Tidak bisa menambahkan menu ke keranjang', 'Ada transaksi yang sedang berlangsung');
            return redirect('/');
        }

        $menu = Menu::find($request->input('menu_id'));

        $cart = Cart::firstWhere([
            'user_id' => Auth::id(),
            'menu_id' => $request->input('menu_id'),
            'jenis_harga' => $request->input('jenis_harga'),
        ]);

        if ($cart) {
            // Update the existing cart item
            $cart->qty += $request->input('quantity');
            $cart->subtotal = $cart->qty * $cart->harga;
        } else {
            // Create a new cart item
            $cart = new Cart;
            $cart->user_id = Auth::id();
            $cart->menu_id = $request->input('menu_id');
            $cart->qty = $request->input('quantity');
            $cart->jenis_harga = $request->input('jenis_harga');
            $cart->harga = ($cart->jenis_harga == 'hot') ? $menu->H_Hot : (($cart->jenis_harga == 'ice') ? $menu->H_Ice : 0);
            $cart->subtotal = $cart->qty * $cart->harga;
        }

        $cart->save();

        return redirect("/cart");
    }

    public function show($id_keranjang)
    {
        $cartItem = Cart::where("id_keranjang", $id_keranjang)->first();

        return view("editcart", compact("cartItem"));
    }

    public function update(Request $request, $id_keranjang)
    {

        $cart = Cart::find($id_keranjang);

        if (!$cart) {
            // Handle the case where the cart item is not found
            return redirect()->back()->with('error', 'Cart item not found');
        }

        $menu = Menu::find($cart->menu_id);

        $cart->qty = $request->input('quantity');
        $cart->jenis_harga = $request->input('jenis_harga');
        $cart->harga = ($cart->jenis_harga == 'hot') ? $menu->H_Hot : (($cart->jenis_harga == 'ice') ? $menu->H_Ice : 0);
        $cart->subtotal = $cart->qty * $cart->harga;

        $cart->save();

        return redirect("/cart");
    }

    public function delete($id_keranjang)
    {
        $cartItem = Cart::where("id_keranjang", $id_keranjang)->first();
        // Delete the cart item
        $cartItem->delete();

        Alert::toast('Berhasil di hapus', 'success');
        return redirect('/cart');
    }
}
