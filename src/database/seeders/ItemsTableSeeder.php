<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Condition;
use App\Models\Item;
use App\Models\Like;


class ItemsTableSeeder extends Seeder
{
    public function run()
    {
        $params = [
            [
                'name' => '腕時計',
                'price' => 15000,
                'brand'=> 'Rolax',
                'description' => 'スタイリッシュなデザインのメンズ時計',
                'img_url' => 'public/img/mens_clock.jpg',
                'user_id' => 2,
                'condition_id' => Condition::$UNUSED, //condition.phpにある配列
            ],
            [
                'name' => 'HDD',
                'price' => 5000,
                'brand' => '西芝',
                'description' => '高速で信頼性の高いハードディスク',
                'img_url' => 'public/img/hard_disk.jpg',
                'user_id' => 2,
                'condition_id' => Condition::$HARMLESS,
            ],
            [
                'name' => '玉ねぎ3束',
                'price' => 300,
                'brand' => '',
                'description' => '新鮮な玉ねぎ３束のセット',
                'img_url' => 'public/img/onion.jpg',
                'user_id' => 2,
                'condition_id' => Condition::$HARMED,
            ],
            [
                'name' => '革靴',
                'price' => 4000,
                'brand' => '',
                'description' => 'クラッシックなデザインの革靴',
                'img_url' => 'public/img/leather_shoes.jpg',
                'user_id' => 2,
                'condition_id' => Condition::$BAD_CONDITION,
            ],
            [
                'name' => 'ノートPC',
                'price' => 45000,
                'brand' => '',
                'description' => '高性能なノートパソコン',
                'img_url' => 'public/img/laptop_PC.jpg',
                'user_id' => 2,
                'condition_id' => Condition::$UNUSED,
            ],
            [
                'name' => 'マイク',
                'price' => 8000,
                'brand' => '',
                'description' => '高音質のレコーディング用マイク',
                'img_url' => 'public/img/mic.jpg',
                'user_id' => 2,
                'condition_id' => Condition::$HARMLESS,
            ],
            [
                'name' => 'ショルダーバッグ',
                'price' => 3500,
                'brand' => '',
                'description' => 'おしゃれなショルダーバッグ',
                'img_url' => 'public/img/shoulder_bag.jpg',
                'user_id' => 1,
                'condition_id' => Condition::$HARMED,
            ],
            [
                'name' => 'タンブラー',
                'price' => 500,
                'brand' => '',
                'description' => '使いやすいタンブラー',
                'img_url' => 'public/img/tumbler.jpg',
                'user_id' => 1,
                'condition_id' => Condition::$BAD_CONDITION,
            ],
            [
                'name' => 'コーヒーミル',
                'price' => 4000,
                'brand' => 'Starbacks',
                'description' => '手動のコーヒーミル',
                'img_url' => 'public/img/coffer_mill.jpg',
                'user_id' => 1,
                'condition_id' => Condition::$UNUSED,
            ],
                [
                'name' => 'メイクセット',
                'price' => 2500,
                'brand' => '',
                'description' => '便利なメイクアップセット',
                'img_url' => 'public/img/make_set.jpg',
                'user_id' => 1,
                'condition_id' => Condition::$HARMLESS,
            ],
        ];

        $range = count($params); //$paramsの中に入っている配列の個数を数えて$rangeに保存する
        for ($i = 0; $i < $range; $i++){ //$i=0からスタートして$i<$range最後の要素まで繰り返すループ処理。
            Item::create($params[$i]);//params[$i]から一件ずつ商品データを取り出し、itemsテーブルに保存する
        }

        // いいね情報をlikesテーブルに保存
        Like::create([
            'user_id' => 1,
            'item_id' => 1,
        ]);
        Like::create([
            'user_id' => 2,
            'item_id' => 7,
        ]);
    }
}
