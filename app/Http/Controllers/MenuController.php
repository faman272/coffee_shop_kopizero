<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\User;
use App\Models\Cart;

class MenuController extends Controller
{
    public function index() {
        $menus = Menu::all();
        return view("home", compact("menus"));
    }

    public function show($id) {
        $menu = Menu::where("id_menu", $id)->first();
        return view("detailmenu", compact("menu"));
    }
}
