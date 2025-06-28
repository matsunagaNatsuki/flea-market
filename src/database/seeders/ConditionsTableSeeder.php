<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Condition;

class ConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            [
                'condition' => '良好',
            ],
            [
                'condition' => '目立った傷や汚れなし',
            ],
            [
                'condition' => 'やや傷や汚れあり'
            ],
            [
                'condition' => '状態が悪い',
            ],
        ];

        $range = count($params); //商品の状態が入った配列の中に何個あるか数えた結果をデータベースに保存する
        for ($i = 0; $i <$range; $i++) {
            Condition::create($params[$i]);
        }
        
    }
}
