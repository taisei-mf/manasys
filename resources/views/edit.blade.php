@section('title', '投稿画面')

@section('content')
    <body>
        <div class="content">
            <div>
                ProductEdit
            </div>

            <div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>product_name</th>
                            <th>company_id</th>
                            <th>price</th>
                            <th>stock</th>
                            <th>comment</th>
                            <th>img_path</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <form action="{{ route('update', ['id' => $products -> id]) }}" method=post enctype="multipart/form-data">
                            @csrf
                                <td>{{ $products -> id }}</td>
                                <td>
                                    <label>*</label>
                                    <input type="text" id="product_name" name="product_name" placeholder="{{ $products -> product_name }}" value="{{ old('product_name') }}" require>
                                    @if($errors -> has('product_name'))
                                        <p>{{ $errors -> first('product_name') }}</p>
                                    @endif
                                </td>                                
                                <td>
                                    <label for="company_id">* メーカーID</label>
                                    <select class="form-control" id="company_id" name="company_id" value="{{ old('company_id') }}" placeholder="{{ $products -> company_id }}">
                                    @foreach ($companies as $company)
                                        <option>{{ $company -> id }}</option>
                                    @endforeach
                                    </select>
                                </td>
                                <td>
                                    <label>*</label>
                                    <input type="number" id="price" name="price" placeholder="{{ $products -> price }}" value="{{ old('price') }}">
                                    @if($errors -> has('price'))
                                        <p>{{ $errors -> first('price') }}</p>
                                    @endif
                                </td>
                                <td>
                                    <label>*</label>
                                    <input type="number" id="stock" name="stock" placeholder="{{ $products -> stock }}" value="{{ old('stock') }}">
                                    @if($errors -> has('stock'))
                                        <p>{{ $errors -> first('stock') }}</p>
                                    @endif
                                </td>
                                <td>
                                    <textarea id="comment" name="comment" placeholder="{{ $products -> comment }}">{{ old('comment') }}</textarea>
                                </td>
                                <td><input type="file" id="img_path" name="img_path" value="{{ old('img_path') }}"></td>
                                <td>
                                    <input type="submit" value="更新">
                                </td>
                            </form>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <form action="{{ route('detail', ['id' => $products -> id]) }}" method="get">
                    @csrf
                    <input type="submit" id="detail" name="detail" value="戻る" >
                </form>

            </div>
        </div>
    </body>
</html>
