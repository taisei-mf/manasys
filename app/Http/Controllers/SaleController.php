<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
//use App\Models\Company;
use App\Models\Sale;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;

use App\Http\Requests\ManasysRequest;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SaleController extends Controller
{
    //
    /*public function __construct()
    {
        $this->product = new Product();
        $this->company = new Company();
        $this->sale = new Sale();
    }*/

    public function index()
    {
       try {
            $sale = Sale::first();
            $result = [
                'result'      => true,
                'id'     => $sale->id,
                'product_id' => $sale->product_id
            ];


        } catch(\Exception $e){
            $result = [
                'result' => false,
                'error' => [
                    'messages' => [$e->getMessage()]
                ],
            ];
            return $this->resConversionJson($result, $e->getCode());
        }
        return $this->resConversionJson($result);
    }

    private function resConversionJson($result, $statusCode=200)
    {
        if(empty($statusCode) || $statusCode < 100 || $statusCode >= 600){
            $statusCode = 500;
        }
        return response()->json($result, $statusCode, ['Content-Type' => 'application/json'], JSON_UNESCAPED_SLASHES);
    }

    /**
     * メンバー作成.
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request) {
        $sale = Sale::create([
            'product_id' => $request->product_id
        ]);

        $model = new Product;
        $product = $model->apiStock($sale);//ProductControllerの一番下*/
        //$product = $this->apiStock($sale);//ProductControllerの一番下*/

        return response()->json($sale);
    }

}
