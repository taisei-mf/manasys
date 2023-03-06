//console.log("Hello World");

//ソート機能
$(document).ready(function() {
    $('#list_table').tablesorter();
});


//ajax練習
$('#prac').click(
  function(){
    var ajj = "ajjt";
          console.log(ajj);
          //var url = location.origin + '/manasys/public/proto' + ajj;
          //var url = '/pproto/' + ajj;
          //var url ='http://127.0.0.1:8000' + '/manasys/public/proto/' + ajj;
          var url = "pproto";
  $.ajax({
    method: "POST",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: url, // url: は読み込むURLを表す
    //asynk: false,
    /*beforeSend: function(jqXHR, setting){
      alert( setting.type ); // 'POST'
      alert( setting.url );
    },*/
    data:{
      "iii":ajj,
    },
    dataType: "json", // 読み込むデータの種類を記入

})
.done(function (data, textStatus, jqXHR) {
        console.log("data : " + data);
        console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
        console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
        console.log(url)
        alert('ファイルの取得に成功しました。');
}).fail(function (jqXHR, textStatus, errorThrown) {
        // 通信失敗時の処理
        console.log("ajax通信に失敗しました");
        console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
        console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
        console.log("errorThrown    : " + errorThrown.message); // 例外情報
        console.log("URL            : " + url);
        alert('ファイルの取得に失敗しました。');
})
        /*.always(function(){
          alert('always');
        })*/
});


//一覧表示
$('#list_display').click(
  function(){

    var url = "listDisplay";
    
    $('.ltable tbody').empty(); //もともとある要素を空にする

  $.ajax({
    method: "GET",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: url, // url: は読み込むURLを表す
    dataType: "json", // 読み込むデータの種類を記入
})
.done(function (res, textStatus, jqXHR) {

        //console.log("data : " + res);
        console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
        console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー

        let html = '';

        // 通信成功時の処理
        $.each(res, function (index, value) {

          html = `
                  <tr class="product-list">
                    <td class="id">${value.id}</td>
                    <td class="image"><img src="http://localhost:8888/manasys/storage/app/public/${value.img_path}" width=15% height=15%"></td>
                    <td class="name">${value.product_name}</td>
                    <td class="price">${value.price}</td>
                    <td class="stock">${value.stock}</td>
                    <td class="company_id">${value.company_id}</td>
                    <td>
                      <form action="http://localhost:8888/manasys/public/detail${value.id}" method="get">
                          
                          <input type="submit" id="detail" name="detail" value="詳細表示" >
                      </form>
                    </td>
                    <td>
                      <form class="delete_btn">
                        <input data-product_id="${value.id}" type="submit" class="btn-dell" name="delete" value="削除">
                      </form>
                    </td>
                  </tr>
                 `

          $(".ltable tbody").append(html); //できあがったテンプレートを user-tableクラスの中に追加
          });

}).fail(function (jqXHR, textStatus, errorThrown) {
        // 通信失敗時の処理
        console.log("ajax通信に失敗しました");
        console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
        console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
        console.log("errorThrown    : " + errorThrown.message); // 例外情報
        alert('ファイルの取得に失敗しました。');
})
        /*.always(function(){
          alert('always');
        })*/
});


//検索処理
$(function(){ // 遅延処理
  $('#search').click(
    function(e) {
      e.preventDefault();
      var productName = $('#product_name').val();
      var companyId   = $('#company_id').val();
      var bottomPrice = $('#bottom_price').val();
      var topPrice    = $('#top_price').val();
      var bottomStock = $('#bottom_stock').val();
      var topStock    = $('#top_stock').val();

      /*if (!productName) {
        return false;
      }*/ //ガード節で検索ワードが空の時、ここで処理を止めて何もビューに出さない
      
      $('.ltable tbody').empty(); //もともとある要素を空にする

    $.ajax({
      async:true,
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: 'search', // url: は読み込むURLを表す
      data: {        //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
        'pName': productName,
        'cId'  : companyId,
        'bPrice': bottomPrice,
        'tPrice'   : topPrice,
        'bStock': bottomStock,
        'tStock'   : topStock,
      },
      //dataType: 'html', // 読み込むデータの種類を記入
      dataType: 'json', // 読み込むデータの種類を記入
      })

      //.done(function (data, textStatus, jqXHR) {
      .done(function(res, textStatus, jqXHR) {

        let html = '';
        
        // 通信成功時の処理
        $.each(res, function (index, value) {

          console.log(index + ":" + value.product_name);
          //console.log("data : " + res);
          console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
          console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー

          html = `
                  <tr class="product-list">
                    <td class="id">${value.id}</td>
                    <td class="image"><img src="http://localhost:8888/manasys/storage/app/public/${value.img_path}" width=15% height=15%"></td>
                    <td class="name">${value.product_name}</td>
                    <td class="price">${value.price}</td>
                    <td class="stock">${value.stock}</td>
                    <td class="company_id">${value.company_id}</td>
                    <td>
                      <form action="http://localhost:8888/manasys/public/detail${value.id}" method="get">
                          
                          <input type="submit" id="detail" name="detail" value="詳細表示" >
                      </form>
                    </td>
                    <td>
                      <form class="delete_btn">
                        <input data-product_id="${value.id}" type="submit" class="btn-dell" name="delete" value="削除">
                      </form>
                    </td>
                  </tr>
                 `

          $(".ltable tbody").append(html); //できあがったテンプレートを user-tableクラスの中に追加
          });

          //alert('ファイルの取得に成功しました。');
      })

      .fail(function (jqXHR, textStatus, errorThrown) {
        // 通信失敗時の処理
        //console.log(data[0]);
        console.log("ajax通信に失敗しました");
        console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
        console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
        console.log("errorThrown    : " + errorThrown.message); // 例外情報
        alert('ファイルの取得に失敗しました。');
      })
      /*.always(function(){
        alert('always');
      });*/
    }
  );
});



//削除処理
  $(function() {
    $(document).on('click', '.btn-dell', function() {
  
      var deleteConfirm = confirm('削除してよろしいでしょうか？');

      if(deleteConfirm == true) {
        var clickEle = $(this);
        // 削除ボタンにユーザーIDをカスタムデータとして埋め込んでます。
        var productID = clickEle.attr('data-product_id');

        $.ajax({
          async:true,
          url:"delete",
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          datatype: 'json',
          data: {'id': productID,
          //       '_method':'DELETE' }, // DELETE リクエストだよ！と教えてあげる。
          },
        })

       .done(function(res) {
          // 通信が成功した場合、クリックした要素の親要素の <tr> を削除
          $(this).parents('tr').remove();
          $(this).unwrap();
          
          console.log(res);
          console.log(clickEle.parents('tr'));
          alert(res);
        })

        .fail(function (jqXHR, textStatus, errorThrown) {
          // 通信失敗時の処理
          //console.log(data[0]);
          console.log("ajax通信に失敗しました");
          console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
          console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
          console.log("errorThrown    : " + errorThrown.message); // 例外情報
          console.log("URL            : " + url);
          alert('ファイルの取得に失敗しました。');
        })
      } else {
        (function(e) {
          e.preventDefault()
        });
      };
    });
  });
