<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // テーブルのクリア
        DB::table('products')->truncate();

        // 初期データ用意（列名をキーとする連想配列）
        $products = [
                        ['company_id' => '1',
                         'product_name' => 'Pen',
                         'price' => 100,
                         'stock' => 200,
                         'comment' => 'You can write!',
                         'img_path' => 'a'],
                        ['company_id' => '2',
                        'product_name' => 'Eracer',
                        'price' => 50,
                        'stock' => 100,
                        'comment' => 'You can wipe out!',
                        'img_path' => 'a'] ,
                        ['company_id' => '2',
                        'product_name' => 'Ruler',
                        'price' => 60,
                        'stock' => 100,
                        'comment' => 'You can measure!',
                        'img_path' => 'a']
        ];

        //登録
        foreach($products as $product){
            \App\Models\Product::create($product);
        }
    }
}
