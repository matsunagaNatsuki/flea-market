<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sell;
use App\Models\Category;

class SellCategorySeeder extends Seeder
{
    public function run()
    {
        $sells = Sell::all();
        $categories = Category::all();

        foreach ($sells as $sell) {
            $randomCategories = $categories->random(rand(1,2));
            $sell->categories()->attach($randomCategories->pluck('id')->toArray());
        }
    }
}
