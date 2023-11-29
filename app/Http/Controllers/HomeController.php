<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Models\Cart;

class HomeController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view("home", compact("menus"));
    }
}