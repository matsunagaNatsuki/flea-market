<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Model\Condition;

class SellFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement
            ([
                '腕時計', 'HDD', '玉ねぎ3束', '革靴', 'ノートPC', 'マイク', 'ショルダーバック', 'タンブラー', 'コーヒーミル', 'メイクセット'
            ]),
            'price' => $this->faker->randomElement
            ([15000, 5000, 300, 4000, 45000, 8000, 3500, 500, 4000, 2500]),
            'description' => $this->faker->randomElement([
                'スタイリッシュなデザインのメンズ時計',
                '高速で信頼性の高いハードディスク',
                '新鮮な玉ねぎ３束のセット',
                'クラッシックなデザインの革靴',
                '高性能なノートパソコン',
                '高音質のレコーディング用マイク',
                'おしゃれなショルダーバッグ',
                '使いやすいタンブラー',
                '手動のコーヒーミル',
                '便利なメイクアップセット',
            ]),
            'image_url' => $this->faker->randomElement([
                'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
                'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
                'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
                'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
                'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
                'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
                'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
                'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
                'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
                'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
            ]),
            'condition_id' => Condition::inRandomOrder()->first()->id,
        ];
    }
}
