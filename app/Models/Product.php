<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    //hasMany設定
    public function sales()
    {
        //usersテーブルとのリレーションを定義するuserメソッド
        //return $this->belongsTo(Sale::class);
        return $this->hasMany('App\Models\Sale');
    }

    //belongsTo設定
    public function companies()
    {
        //reviewsテーブルとのリレーションを定義するreviewメソッド
        //return $this->belongsTo(Company::class);
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

    /**
     * 検索処理（商品名）
     */
    public function searchKeyword($product_name, $company_id, $bottom_price, $top_price, $bottom_stock, $top_stock){

        $query = Product::query();

        if(!empty($product_name)) {
            $query->where('product_name', 'LIKE', "%{$product_name}%");
        }

        if(!empty($company_id)) {
            $query->where('company_id', 'LIKE', "%{$company_id}%");
        }

        if(!empty($bottom_price) && !empty($top_price)) {
            $query->whereBetween('price', [$bottom_price, $top_price]);
        }

        if(!empty($bottom_stock) && !empty($top_stock)) {
            $query->whereBetween('stock', [$bottom_stock, $top_stock]);
        }

        $products = $query->get();

        return $products;

    }

    /**
     * 検索処理（企業ID）
     */
    public function searchCID(){

        $query = Product::query();
        $companies = $query->get();

        return $companies;


    }

    /**
     * 登録処理
     */    
    public function registProduct($data, $path) {
        // 登録処理
        DB::table('products')->insert([
            'company_id' => $data->company_id,
            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $path,
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
    public function updateProduct($request, $product, $path){
        $result = $product->fill([
            'product_name' => $request->product_name,
            'company_id' => $request->company_id,            
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            'img_path' => $path,
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ])->save();

        return $result;
    }

    /**
     * api試験
     */
    public function apiStock($sale){
        //
        //console.log($sale);
        $p_id = $sale->product_id;
        $product = Product::find($p_id);

        $p_stock = $product->stock;

        if($p_stock == 0){
            //買えませんのアラート
            $result = [
                'result' => false,
                'error' => [
                'messages' => [$e->getMessage()]
                ],
            ];
            return $this->resConversionJson($result, $e->getCode());
        }
        elseif($p_stock != 0){
            $p_stock --;

            $result = $product->fill([

                'stock' => $p_stock,

            ])->save();
        }
        //return $result;
        
    }


}
