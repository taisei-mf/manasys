<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    //hasMany設定
    public function sales()
    {
        return $this->hasMany('App\Models\Sale');
    }

    //belongsTo設定
    public function companies()
    {
        return $this->belongsTo('App\Models\Company');
    }

    // 登録・更新可能なカラムの指定
    protected $fillable = [
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
        'created_at',
        'updated_at'
    ];

    public function getList() {
        // productsテーブルからデータを取得
        $products = DB::table('products')->get();

        return $products;
    }
    
    public function getListt() {
        // companiesテーブルからデータを取得
        $companies = DB::table('companies')->get();

        //dd($companies);
        return $companies;
    }


    public function registProduct($data) {
        // 登録処理
        DB::table('products')->insert([
            'company_id' => $data->company_id,
            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $data->img_path,
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ]);
    }

    /**
     * 削除処理
     */
    public function deleteProductById($id)
    {
        return $this->destroy($id);
    }

    /**
     * 詳細表示
     */
    public function getDesignate($id) {
        // productsテーブルからデータを取得
        $products = DB::table('products')->find($id);

        return $products;
    }

    /**
     * 編集処理
     */
    public function getProductDetail($id) {
        // productsテーブルからデータを取得
        //$products = DB::table('products')->get($id);
        $detail = Product::find($id);

        //return $products;
        return view('detail', compact('detail'));
    }

        
    /**
     * 更新処理
     */
    public function updateProduct($request, $product){
        $result = $product->fill([
            'product_name' => $request->product_name,
            'company_id' => $request->company_id,            
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            'img_path' => $request->img_path,
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ])->save();

        return $result;
    }
}