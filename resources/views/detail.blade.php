@section('title', '投稿画面')

@section('content')
    <body>
        <div class="content">
            <div>
                ProductDetail
            </div>

            <div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>img_path</th>
                            <th>product_name</th>    
                            <th>company_id</th>
                            <th>price</th>
                            <th>stock</th>
                            <th>comment</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>{{ $products -> id }}</td>
                            <td>{{ $products -> img_path }}</td>
                            <td>{{ $products -> product_name }}</td>
                            <td>{{ $products -> company_id }}</td>
                            <td>{{ $products -> price }}</td>
                            <td>{{ $products -> stock }}</td>
                            <td>{{ $products -> comment }}</td>

                            <td>
                                <form action="{{ route('edit', ['id' => $products -> id]) }}" method="get">
                                @csrf
                                    <input type="submit" id="edit" name="edit" value="編集" >
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div>
                <form action="{{ route('list') }}" method="get">
                @csrf
                    <input type="submit" value="戻る" >
                </form>
            </div>
        </div>
    </body>
</html>
