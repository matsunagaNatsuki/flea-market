<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Season::create(['name' => '良好']);
        Season::create(['name' => '目立った傷や汚れなし']);
        Season::create(['name' => 'やや傷や汚れあり']);
        Season::create(['name' => '状態が悪い']);
    }
}
