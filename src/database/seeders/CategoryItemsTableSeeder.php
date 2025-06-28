<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryItem;

class CategoryItemsTableSeeder extends Seeder
{
    public function run()//seederが実行されたときに動く関数
    {
        $sneaker_categories = [1,5,9]; //カテゴリ配列(ID)のリストと登録したい値
        foreach($sneaker_categories as $sneaker_category) { //カテゴリーのリストの中の登録した値を取り出して繰り返す
            CategoryItem::create([
                'item_id' => 1,
                'category_id' => $sneaker_category,
            ]);
            // 商品IDとカテゴリIDのペアをデータベースに保存
        }

        $hat_categories = [1,4];
        foreach($hat_categories as $hat_category) {
            CategoryItem::create([
                'item_id' => 2,
                'category_id' => $hat_category,
            ]);
        }

        $glasses_categories = [1,12];
        foreach ($glasses_categories as $glasses_category) {
            CategoryItem::create([
                'item_id' => 3,
                'category_id' => $glasses_category,
            ]);
        }

        $tv_categories = [2,3];
        foreach ($tv_categories as $tv_category) {
            CategoryItem::create([
                'item_id' => 4,
                'category_id' => $tv_category,
            ]);
        }

        $wallet_categories = [1,5,12];
        foreach ($wallet_categories as $wallet_category) {
            CategoryItem::create([
                'item_id' => 5,
                'category_id' => $wallet_category,
            ]);
        }

        $earrings_categories = [1,4,12];
        foreach ($earrings_categories as $earrings_category) {
            CategoryItem::create([
                'item_id' => 6,
                'category_id' => $earrings_category,
            ]);
        }
    }
}