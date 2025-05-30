<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use App\Models\Condition;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ExhibitionRequest;

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

    public function sell(Request $request){
        $images = Storage::files('public/images');
        $categories = Category::all();
        $conditions = Condition::all();

        return view('sell', compact('categories', 'conditions', 'images'));
    }

    public function store (ExhibitionRequest $request) {
        $sell = Sell::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'brand' => $request->brand,
            'image' => $request->image,
            'condition_id' => $request->condition_id,
            'user_id' => auth()->id()
        ]);

        $sell->save();

        $category = Category::find($request->category_id);
        $sell->categories()->attach($category->id);

        return redirect('/');

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
