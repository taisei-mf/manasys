<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // テーブルのクリア
        DB::table('companies')->truncate();

        // 初期データ用意（列名をキーとする連想配列）
        $companies = [
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
        foreach($companies as $company){
            \App\Models\Company::create($company);
        }
    }
}
