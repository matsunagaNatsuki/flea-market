<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(ConditionsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(CategoryItemsTableSeeder::class);
    }
}
