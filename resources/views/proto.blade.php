@extends('layouts.app')

@section('title', '投稿画面')

@section('content')    
    <body>
         <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif 

            @csrf
            <div class="content">
                <div class="title m-b-md">
                    Proto~~
                </div>



            <div>
            <!-- Jqueryチェック
            <a href="http://google.com">Google</a>
            <script type="text/javascript">
            $(function(){
                $("a[href^='http://']").attr("target","_blank");
            });
            </script>
            -->

            <input type='button' id='prac'>

            <?php
                    $key = "a";
                    echo ($key);
                    //dd($keyword);
                    ?>

                <form class="word_search">
                    <input type="text" name="word" id="word">
                    <input type="submit" value="検索" id='shiken'>
                </form>

                <div id="listt" class="ltabel">
                    <label>商品リスト</label>
                    <div>
                        <table>
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
                            <tbody id="body">
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->img_path }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->company_id }}</td>
                                    <td>
                                        <form action="{{ route('detail', ['id'=>$product->id]) }}" method="post">
                                            @csrf
                                            <input type="submit" id="detail" name="detail" value="詳細表示" >
                                        </form>
                                    </td>
                                    <td>
                                        <form class="delete_btn">
                                            <input data-product_id="{{$product->id}}" type="submit" class="btn-dell" name="delete" value="削除">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



            

                <div class="search">

                    <?php
                    $keyword = "a";
                    //dd($keyword);
                    ?>
                    <form action="{{ route('search', ['keyword' => $keyword]) }}" method="post">
                    @csrf
                        <label>検索したい商品名を入力してください。</label>
                        <input type="search" name="keyword" placeholder="キーワードを入力" value="@if (isset($keyword)){{ ($keyword) }} @endif">

                        <label>検索したい企業IDを選択してください。</label>
                        <select id="company_id" name="company_id" value="" placeholder="企業名検索">
                        @foreach ($companies as $company)
                            <option>{{ $company->id }}</option>
                        @endforeach
                        </select>

                        <input type="submit" name="submit" value="検索">
                    </form>
                    
                    <a type='button' href="{{ route('regist') }}">新規登録</a>
                    <!--<a type='button' href="{{ route('hasmany') }}">hasmany</a>-->
                </div>
                
                <div id="" class="">
                    <label>商品リスト</label>
                    <div>
                        <table>
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
                            <tbody id="body">
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->img_path }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->company_id }}</td>
                                    <td>
                                        <form action="{{ route('detail', ['id'=>$product->id]) }}" method="post">
                                            @csrf
                                            <input type="submit" id="detail" name="detail" value="詳細表示" >
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('product.destroy', ['id'=>$product->id]) }}" method="post">
                                            @csrf
                                            <input type="submit" id="delete" name="delete" value="削除" onclick="return confirm('{{ $product->id }}:{{ $product->product_name }}を削除しますか?');">
                                        </form>
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
