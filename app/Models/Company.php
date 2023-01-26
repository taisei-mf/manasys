<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    //hasMany設定
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }


    public function getListt() {
        // companiesテーブルからデータを取得
        $companies = DB::table('companies')->get();


        //dd($companies);
        return $companies;
    }
}
