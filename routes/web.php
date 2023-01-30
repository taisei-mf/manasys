<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/', function () {
//    return view('welcome');
//})->name('/');

Route::get('/','LoginController@showLoginForm')->name('/');


//list表示
Route::get('/list','ProductController@showList')->name('list');
//Route::get('/pproto','ProductController@showList')->name('list');

//regist表示
Route::get('/regist','ProductController@showRegist')->name('regist');

//detail表示
Route::post('/detail{id}','ProductController@showDetail')->name('detail');

//edit表示
Route::get('/edit{id}','ProductController@showEdit')->name('edit');



//登録処理ルート
Route::post('/regist','ProductController@registSubmit')->name('submit');

//削除処理ルート
//Route::post('/destroy{id}', [ManasysController::class, 'destroy'])->name('product.destroy');
Route::post('/destroy{id}', 'ProductController@destroy')->name('product.destroy');

//検索処理ルート
Route::post('/list','ProductController@searchProduct')->name('product.search');
Route::put('/list','ProductController@searchCompanyID')->name('company.search');

//更新処理ルート
Route::post('/edit{id}','ProductController@update')->name('update');


//画像表示ルート
//Route::get('/', [ItemController::class, 'index'])->name('item.index');
//Route::get('/create', [ItemController::class, 'create'])->name('item.create');
//Route::post('/store', [ItemController::class, 'store'])->name('item.store');

Route::patch('/list', 'ProductController@index')->name('item.index');
Route::get('/create', 'ProductController@create')->name('item.create');
Route::post('/store', 'ProductController@store')->name('item.store');


/*
//結合表示 Companies & Products
Route::get('/proto','ProductController@showProto'

    function(){

    //company_id=1の製品を取得
    $company = App\Models\company::find(1);

    //company_id=1に所属する製品を取得
    $products = $company->products;

    //dd($products);

    //部署名表示
    echo "メーカーid: ".$company->company_name."<br>";

    //メンバー表示
    foreach($products as $product)
    {
        echo $product->product_name."<br>";
    }

    //人数表示
    echo $products->count()."個<br>";

}
)->name('hasmany');*/
