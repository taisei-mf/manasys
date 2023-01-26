<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Company;
//use App\Models\Sale;

use App\Http\Requests\ManasysRequest;

use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->product = new Product();
    }

    //list表示
    public function showList()
    {
        // インスタンス生成
        //$model = new Product();
        //$products = $model->getList();
        $products = $this->product -> getList();

        $modell = new Company();
        $companies = $modell->getListt();

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
        $modell = new Company();
        $companies = $modell->getListt();

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

        $modell = new Company();
        $companies = $modell->getListt();

        return view('edit', ['products' => $products, 'companies' => $companies]);
    }



    /**
     * 登録処理
     */
    public function registSubmit(ManasysRequest $request)
     {
        // トランザクション開始
        DB::beginTransaction();

        try {
            // 登録処理呼び出し
            $model = new Product();
            $model->registProduct($request);
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
        // 指定されたIDのレコードを削除
        $deleteProduct = $this->product->deleteProductById($id);

        // 削除したら一覧画面にリダイレクト
        return redirect()->route('list');
    }


    /**
     * 検索処理(商品)
     */
    public function searchProduct(Request $request)
    {
        $keyword = $request->input('keyword');

        $modell = new Company();
        $companies = $modell->getListt();

        $query = Product::query();

        if(!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%");
                //->orWhere('author', 'LIKE', "%{$keyword}%");
        }

        $products = $query->get();

        return view('list', compact('products', 'keyword', 'companies'));
        //return redirect()->route('list' , compact('products', 'keyword'));
    }

    /**
     * 検索処理(企業ID)
     */
    public function searchCompany(Request $request)
    {
        $keyword_id = $request->input('company_id');

        //dd($keyword_id);

        $modell = new Company();
        $companies = $modell->getListt();

        $query = Product::query();

        if(!empty($keyword_id)) {
            $query->where('company_id', 'LIKE', "%{$keyword_id}%");
                //->orWhere('author', 'LIKE', "%{$keyword}%");
        }

        $products = $query->get();

        return view('list', compact('products', 'keyword_id', 'companies'));
    }


    /**
     * 更新処理
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $updateProduct = $this->product -> updateProduct($request, $product);

        //return redirect()->route('edit' ,$result->id);
        return redirect(route('edit', $id));
    }

}
