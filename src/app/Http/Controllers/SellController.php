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

    public function item($item_id) {
        $sell = Sell::find($item_id);

        if (!$sell) {
            abort(404);
        }
        return view('item', compact('sell'));
    }

}
