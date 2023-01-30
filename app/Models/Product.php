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

    /**
     * 検索処理（商品名）
     */
    public function searchKeyword($keyword){

        $query = Product::query();

        if(!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%");
        }

        $products = $query->get();

        return $products;
    }

    /**
     * 検索処理（企業ID）
     */
    public function searchCID($keyword_id){

        $query = Product::query();

        if(!empty($keyword_id)) {
            $query->where('company_id', 'LIKE', "%{$keyword_id}%");
        }

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
}
