<?php

use Illuminate\Database\Seeder;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // テーブルのクリア
        DB::table('sales')->truncate();

        // 初期データ用意（列名をキーとする連想配列）
        $sales = [
                        ['company_name' => 'Akagi',
                         'street_address' => 'Akagi building,1-1-1,Kamiyama-ku,Utida-si,Arara,Japan',
                         'representative_name' => 'Tadanori Akagi',],
                         ['company_name' => 'Stationary-E',
                         'street_address' => 'Hihi mansionF8,2-4,grand-street,Lofi-city,Bulizania',
                         'representative_name' => 'John Reach',],
                         ['company_name' => 'Earth Friend',
                         'street_address' => '7-8,Dentou,Haisen-ku,Consent-si,Denki,Japan',
                         'representative_name' => 'Gam Otubu',]
        ];

        //登録
        foreach($sales as $sale){
            \App\Models\Sale::create($sale);
        }
    }
}
