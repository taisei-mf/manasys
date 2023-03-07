<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Company;
use App\Models\Sale;

use App\Http\Requests\ManasysRequest;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->product = new Product();
        $this->company = new company();
    }

    //list表示
    public function showList()
    {
        // インスタンス生成
        //$model = new Product();
        //$products = $model->getList();
        $products = $this->product -> getList();
        $companies = $this->company -> getListt();

        return view('list', compact('products', 'companies'));

    }

        //proto表示
        public function showProto()
        {
            $products = $this->product -> getList();
            
            $companies = $this->company -> getListt();

            //echo ($products);
    
            return view('proto', compact('products', 'companies'));
    
        }

    //regist表示
    public function showRegist()
    {
        $companies = $this->company -> getListt();

        return view('regist', compact('companies'));
    }

    //detail表示
    public function showDetail($id)
    {
        $products = $this->product -> getDesignate($id);
                
        return view('detail', ['products' => $products]);
    }

    //edit表示
    public function showEdit($id) 
    {
        $products = $this->product -> getDesignate($id);

        $companies = $this->company -> getListt();

        return view('edit', ['products' => $products, 'companies' => $companies]);
    }

    /**
     * 登録処理
     */
    public function registSubmit(ManasysRequest $request)
     {
        // トランザクション開始
        DB::beginTransaction();

        if(isset($request->img_path)){
        // 画像フォームでリクエストした画像を取得
        $img = $request->file('img_path');
        // storage > public > img配下に画像が保存される
        $path = $img->store('img', 'public');
        }
        else{
            $path = null;
        }

        try {
            // 登録処理呼び出し
            $this->product -> registProduct($request, $path);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    
        // 処理が完了したらmnrにリダイレクト
        return redirect(route('regist'));
    }


    /**
     * 削除処理
     */
    /*public function destroy($id)
    {
        // トランザクション開始
        DB::beginTransaction();

        try {

            // 指定されたIDのレコードを削除
            $deleteProduct = $this->product->deleteProductById($id);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }

        // 削除したら一覧画面にリダイレクト
        return redirect()->route('list');
    }*/

    /**
     * 検索処理(商品)
     */
    /*public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $company_id = $request->input('company_id');

        $bottom_price = $request->input('bottom_price');
        $top_price = $request->input('top_price');

        $bottom_stock = $request->input('bottom_stock');
        $top_stock = $request->input('top_stock');
        

        $products = $this->product -> searchKeyword($keyword, $company_id, $bottom_price, $top_price, $bottom_stock, $top_stock);

        $companies = $this->company -> getListt();

        return view('list', compact('products', 'companies'));
    }*/
    
    /**
     * 検索処理(企業ID)
     */
    /*public function searchCompanyID(Request $request)
    {
        $companies = $this->company -> getListt();

        $products = $this->product  -> searchCID();

        return view('list', compact('products', 'companies', 'keyword_id'));
    }*/

    /**
     * 検索処理(価格)
     */
    /*public function searchPrice(Request $request)
    {
        $companies = $this->company -> getListt();

        $products = $this->product ;

        return view('list', compact('products', 'companies'));
    }*/

    /**
     * 検索処理(在庫)
     */
    /*public function searchStock(Request $request)
    {
        dd($bottom_stock);

        $companies = $this->company -> getListt();

        $products = $this->product ;

        return view('list', compact('products', 'companies'));
    }
    */


    /**
     * 更新処理
     */
    public function update(ManasysRequest $request, $id)
    {
        // トランザクション開始
        DB::beginTransaction();

        if(isset($request->img_path)){
        // 画像フォームでリクエストした画像を取得
        $img = $request->file('img_path');
        // storage > public > img配下に画像が保存される
        $path = $img->store('img', 'public');
        }
        else{
            $path = null;
        }

        try {
            // 指定されたIDのレコードを更新
            $product = Product::find($id);

            $updateProduct = $this->product -> updateProduct($request, $product, $path);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }

        return redirect(route('edit', $id));
    }


    /**
     * ajax試験
     */
    public function shiken(Request $request) //$keyword
    {
    header("Content-Type: application/json; charset=UTF-8"); //ヘッダー情報の明記。必須。

        $iii = $request->iii;
        //echo ($iii);
        //console.log(iii);
        //echo json_encode($iii);
        //$aaa = ["taisei":taisei];
        return response()->json($iii);
    }

    //検索処理(ajax)
    public function search(Request $request)
    {
        header("Content-Type: application/json; charset=UTF-8"); //ヘッダー情報の明記。必須。
        $product_name = $request->pName;
        $company_id   = $request->cId;

        $bottom_price = $request->bPrice;
        $top_price    = $request->tPrice;

        $bottom_stock = $request->bStock;
        $top_stock    = $request->tStock;
        
        $products = $this->product -> searchKeyword($product_name, $company_id, $bottom_price, $top_price, $bottom_stock, $top_stock);

        //$products = $this->product -> where('product_name', 'LIKE', "%{$product_name}%")->get();
        //$products = $this->product -> where('product_name', 'LIKE', "%" . $product_name . "%")->get();
        $companies = $this->company -> getListt();
        
        return response()->json($products);
    }

    //一覧表示(ajax)
    public function listDisplay()
    {
        $products = $this->product ->get();
        return response()->json($products);
    }

    //削除処理(ajax)
    public function Pdestroy(Request $request, Product $product)
    {
        //echo($request);
        $products = Product::findOrFail($request->id);
        $products->delete();
        return response()->json($products);
    }



    /**
     * api試験　ModelのProductに改良版あり
     */
    public function apiStock($sale){
        //
        console.log($sale);
        $p_id = $sale->product_id;
        $product = Product::find($p_id);

        $p_stock = $product->stock;
        $p_stock --;

        $result = $product->fill([

            'stock' => $p_stock,

        ])->save();

        //return $result;
        
    }

}
