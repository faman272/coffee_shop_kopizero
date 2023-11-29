<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\LogCart;
use App\Models\LogOrder;

class LogsController extends Controller
{
    public function index()
    {

        $logs = Log::all();

        return view('admin.logs.index', compact('logs'));
    }


    public function logCart()
    {

        $logs = LogCart::all();

        return view('admin.logs.logcart', compact('logs'));
    }


    public function logOrder()
    {

        $logs = LogOrder::all();

        return view('admin.logs.logorder', compact('logs'));
    }
}
