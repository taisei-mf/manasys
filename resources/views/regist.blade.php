@section('title', '投稿画面')

@section('content')
    <body>            
        <div class="content">
            <div>
                ProductRegist~商品新規登録~
            </div>

            <div class="form-group">
                <form action="{{ route('submit') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div>
                        <label for="product_name">商品名 *</label>
                        <input type="text" id="product_name" name="product_name" placeholder="商品名" value="{{ old('product_name') }}" require>
                        @if($errors -> has('product_name'))
                            <p>{{ $errors -> first('product_name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="company_id">メーカーID *</label>

                        <select id="company_id" name="company_id" value="{{ old('company_id') }}" require>
                        @foreach ($companies as $company)
                            <option>{{ $company->id }}</option>
                        @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="price">価格 *</label>
                        <input type="number" id="price" name="price" placeholder="価格" value="{{ old('price') }}" require>
                        @if($errors -> has('price'))
                            <p>{{ $errors -> first('price') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="stock">在庫数 *</label>
                        <input type="number" id="stock" name="stock" placeholder="在庫数" value="{{ old('stock') }}" require>
                        @if($errors -> has('stock'))
                            <p>{{ $errors -> first('stock') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="comment">コメント</label>
                        <textarea id="comment" name="comment" placeholder="Comment">{{ old('comment') }}</textarea>
                    </div>

                    <div>
                        <label for="img_path">商品画像</label>
                        <input type="file" id="img_path" name="img_path" value="{{ old('img_path') }}">
                    </div>    

                    <button type='submit' class="btn btn-default">登録</button>
                        
                </form>
            </div>

                <div>
                    <a type='button' href="{{ route('list') }}">戻る</a>
                </div>

        </div>
    </body>
</html>
