<?php

use Illuminate\Database\Seeder;
use App\City;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CategoryTableSeeder::class);
         $this->call(CityTableSeeder::class);
    }
}
class CityTableSeeder extends Seeder 
{
    public function run()
    {
        DB::table('cities')->truncate();
        $cities = [
            ['name' => '臺北市'],
            ['name' => '基隆市'],
            ['name' => '桃園市'],
            ['name' => '新竹縣'],
            ['name' => '新竹市'],
            ['name' => '苗栗縣'],
            ['name' => '臺中市'],
            ['name' => '彰化縣'],
            ['name' => '雲林縣'],
            ['name' => '嘉義縣'],
            ['name' => '嘉義市'],
            ['name' => '臺南市'],
            ['name' => '高雄市'],
            ['name' => '屏東縣'],
            ['name' => '宜蘭縣'],
            ['name' => '花蓮縣'],
            ['name' => '臺東縣'],
            ['name' => '澎湖縣'],
            ['name' => '金門縣'],
            ['name' => '連江縣'],
        ];
        DB::table('cities')->insert($cities);
    }

    
}
class CategoryTableSeeder extends Seeder 
{
    public function run()
    {
        DB::table('categories')->truncate();
        $categories = [
            ['name' => '狗'],
            ['name' => '貓'],
        ];
        DB::table('categories')->insert($categories);
    }

    
}