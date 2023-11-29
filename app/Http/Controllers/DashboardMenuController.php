<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;


class DashboardMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all();
        $categories = Kategori::all();
        return view('admin.menu.index', compact('menus', 'categories'));
    }

    public function show()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $menu = new Menu;

        $menu->nama_menu = $request->input('nama_menu');
        $menu->kategori_id = $request->input('kategori');
        $menu->H_Hot = $request->input('harga_hot');
        $menu->H_Ice = $request->input('harga_ice');
        $menu->deskripsi = $request->input('deskripsi');

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/menu', $filename);
            $menu->gambar = $filename;
        }

        $menu->save();

        Alert::success('Success', 'Menu Berhasil Ditambahkan');
        return redirect()->route('menu.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $categories = Kategori::all();
        return view('admin.menu.edit', compact('menu', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        // dd($request->all());

        $request->validate([
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Delete the old image
            Storage::delete('public/menu/' . $menu->gambar);

            // Store the new image
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('public/menu', $imageName);

            $menu->gambar = $imageName;
        }

        $menu->nama_menu = $request->nama_menu;
        $menu->kategori_id = $request->kategori;
        $menu->H_Hot = $request->harga_hot;
        $menu->H_Ice = $request->harga_ice;
        $menu->deskripsi = $request->deskripsi;

        $menu->save();

        Alert::success('Success', 'Menu Berhasil Diubah');
        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        // Delete the image associated with the menu
        Storage::delete('public/menu/' . $menu->gambar);

        // Delete the menu
        $menu->delete();

        // Redirect the user back to the menu index page with a success message
        Alert::success('Success', 'Menu Berhasil Dihapus');
        return redirect()->route('menu.index');
    }
}
