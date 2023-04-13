<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'image' => '',
                'name' => '水',
                'price' => 100,
                'stock' => 50,
                'company' => '水株式会社',
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'image' => '',
                'name' => 'お茶',
                'price' => 120,
                'stock' => 40,
                'company' => 'お茶株式会社',
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'image' => '',
                'name' => 'サイダー',
                'price' => 150,
                'stock' => 80,
                'company' => '炭酸株式会社',
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'image' => '',
                'name' => '葡萄ジュース',
                'price' => 150,
                'stock' => 50,
                'company' => '葡萄株式会社',
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'image' => '',
                'name' => 'リンゴジュース',
                'price' => 150,
                'stock' => 60,
                'company' => '林檎株式会社',
            ],
        ]);
    }
}
