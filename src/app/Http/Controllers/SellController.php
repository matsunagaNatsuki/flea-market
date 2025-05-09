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
    $sell = Sell::find($sell_id);

    return view('item', compact('sell'));
}

    public function sell(Request $request) {
        return view('sell');
    }

    public function purchase($sell_id) {
    $sell = Sell::find($sell_id);

    return view('purchase', compact('sell'));
    }

}
