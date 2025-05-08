<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use Illuminate\Http\Request;

class SellController extends Controller
{
    public function index()
    {
        $sells = Sell::all();
        return view('index', compact('sells'));
    }

    public function item($sell_id) {

        return view('item');
    }

    public function sell(Request $request) {
        return view('sell');
    }

}
