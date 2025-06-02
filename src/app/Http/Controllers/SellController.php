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
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sells = Sell::query();

        if ($search) {
            $sells=$sells->where('name', 'LIKE', "{$search}%");
        }
        $sells = $sells->get();

        return view('index', compact('sells', 'search'));
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

    public function store(ExhibitionRequest $request) {
        $image = $request->file('image');

        if ($image) {
            $fileName = 'profile_' . uniqid() . '.' . $image->extension();
            $path = $image->storeAs('public/profiles', $fileName);
            $imagePath = Storage::url($path);
        } else {
            $imagePath = null;
        }

        $sell = Sell::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'brand' => $request->brand,
            'image' => $imagePath,
            'condition_id' => $request->condition_id,
            'user_id' => auth()->id()
        ]);

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
