<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Company;
//use App\Models\Sale;

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

        /*//proto表示
        public function showProto()
        {
            $products = $this->product -> getList();
    
            $modell = new Company();
            $companies = $modell->getListt();
    
            return view('proto', compact('products', 'companies'));
    
        }*/

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
    public function destroy($id)
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
    }


    /**
     * 検索処理(商品)
     */
    public function searchProduct(Request $request)
    {
        $keyword = $request->input('keyword');

        $companies = $this->company -> getListt();

        $products = $this->product -> searchKeyword($keyword);

        return view('list', compact('products', 'companies', 'keyword'));
    }
    
    /**
     * 検索処理(企業ID)
     */
    public function searchCompanyID(Request $request)
    {
        $keyword_id = $request->input('company_id');
        
        $companies = $this->company -> getListt();

        $products = $this->product -> searchCID($keyword_id);

        return view('list', compact('products', 'companies', 'keyword_id'));
    }

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

}
