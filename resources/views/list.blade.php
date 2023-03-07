@extends('layouts.app')

@section('title', '投稿画面')

@section('content')    
    <body>
        <div>
            @csrf
            <div class="content">
                <div>
                    ProductList~商品情報一覧~
                </div>

                <div class="search">
                    <!--<form action="{{ route('search') }}" method="post">-->
                    <!--<form action="#" method="get">-->
                    @csrf
                        <label>検索したい商品名を入力してください。</label>
                        <input id="product_name" type="text" name="product_name" placeholder="キーワードを入力" value="{{ old('product_name') }}" >

                        <br></br>

                        <label>検索したい企業IDを選択してください。</label>
                        <select id="company_id" name="company_id" value="@if (isset($company_id)){{ ($company_id) }} @endif" placeholder="企業名検索">
                            <option></option>
                        @foreach ($companies as $company)
                            <option>{{ $company -> id }}</option>
                        @endforeach
                        </select>

                        <br></br>

                        <label>価格検索</label>
                        <input id="bottom_price" type="number" name="bottom_price" value="@if (isset($bottom_price)){{ ($bottom_price) }} @endif">
                        ~
                        <input id="top_price" type="number" name="top_price" value="@if (isset($top_price)){{ ($top_price) }} @endif">

                        <br></br>

                        <label>在庫数検索</label>
                        <input id="bottom_stock" type="number" name="bottom_stock" value="@if (isset($bottom_stock)){{ ($bottom_stock) }} @endif">
                        ~
                        <input id="top_number" type="number" name="top_stock" value="@if (isset($top_stock)){{ ($top_stock) }} @endif">

                        <input type="submit" value="検索" id="search">
                        <a type="button"  id="list_display" href="#">一覧表示</a>
                    <!--</form>-->   
                </div>

                <div>
                    <a type='button' href="{{ route('regist') }}">新規登録</a>
                    <!--<a type='button' href="{{ route('hasmany') }}">proto</a>-->
                </div>
                
                <div>
                    <label>商品リスト</label>

                    <div>
                        <table id="list_table" class="ltable">

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>img_path</th>
                                    <th>product_name</th>
                                    <th>price</th>
                                    <th>stock</th>    
                                    <th>company_id</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach ($products as $product)
                                <tr class="target", id="target">
                                    <td class="id">{{ $product -> id }}</td>
                                    <?php
                                    $imgpath = $product -> img_path;
                                    //echo $imgpath;
                                    ?>
                                    <td class="image"><img src="{{ url('storage/' . $imgpath) }}" width=15% height=15%></td>
                                    <td class="name">{{ $product -> product_name }}</td>
                                    <td class="price">{{ $product -> price }}</td>
                                    <td class="stock">{{ $product -> stock }}</td>
                                    <td class="company_id">{{ $product -> company_id }}</td>

                                    <td>
                                        <form action="{{ route('detail', ['id' => $product -> id]) }}" method="get">
                                            @csrf
                                            <input type="submit" id="detail" name="detail" value="詳細表示" >
                                        </form>
                                    </td>

                                    <td>
                                        <!--<form action="{{ route('product.destroy', ['id' => $product -> id]) }}" method="post">
                                        <form class="delete_btn">
                                            @csrf
                                            <input data-product_id="{{$product->id}}" type="submit" id="delete" name="delete" value="削除" onclick="return confirm('{{ $product -> id }}:{{ $product -> product_name }}を削除しますか?');">
                                        </form>-->

                                        <form class="delete_btn">
                                            <input data-product_id="{{$product->id}}" type="submit" class="btn-dell" name="delete" value="削除">
                                        </form>

                                        <!--<button data-product_id="{{$product->id}}" type="submit" class="btn-dell" name="delete" value="削除">削除</button>-->
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
