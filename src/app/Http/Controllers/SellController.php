<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use App\Models\Condition;
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
        $conditions = Condition::all();
        return view('sell', compact('conditions'));
    }

    public function store (Request $request) {
        $sell = sell::create($request->only(['name', 'price', 'description', 'brand', 'image', 'condition_id', 'user_id']));

        $category = Category::firstOrCreate(['name' => $request->category]);

        $sell->categories()->attach($category->id);

        return redirect()->route('/');

    }

    public function purchase($item_id) {
    $sell = Sell::find($item_id);

    if(!$sell) {
        abort(404);
    }

    return view('purchase', compact('sell'));
    }

    public function address($item_id)
    {
        $sell = Sell::find($item_id);

        if (!$sell) {
            abort(404);
        }

        return view('address', compact('sell'));
    }



}
