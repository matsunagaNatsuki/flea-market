<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
                'ファッション',
                '家電',
                'インテリア',
                'レディース',
                'メンズ',
                'コスメ',
                '本',
                'ゲーム',
                'スポーツ',
                'キッチン',
                'ハンドメイド',
                'アクセサリー',
                'おもちゃ',
                'ベビー・キッズ',
        ];

        $range = count($params);//$paramsの中にカテゴリを数えて保存する
        for ($i = 0 ; $i < $range ; $i++){
            Category::create([
                'category' => $params[$i],
            ]);
        }
        //paramsの中に入っているカテゴリを一つ一つ繰り返し取り出し、取り出したカテゴリをデータベースに保存する
    }
}
