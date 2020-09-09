<?php 
// ------------------------------------管理端頁面----------------------------------------------
session_start();
if (isset($_SESSION["managerName"])) { // 判斷登入與否
  $managerName = $_SESSION["managerName"];
}
else {
  echo "<script> alert('請先登入！'); window.location='manageLogin.php' </script>";
  exit();
}


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title>商品管理</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- <link rel="stylesheet" href="css/core-style.css"> -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/style_ok.css">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</head>

<body>

  <header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
      <nav class="classy-navbar" id="essenceNav">
        <a class="nav-brand" href="manageIndex.php"><img src="img/core-img/logo_plainB.png" alt=""></a>
        <div class="classy-navbar-toggler">
          <span class="navbarToggler"></span>
        </div>
        <div class="classy-menu">
          <div class="classycloseIcon">
            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
          </div>
          <div class="classynav">
            <ul>
              <li><a href="productManage.php">商品管理</a></li>
              <li><a href="#">會員管理</a></li>
            </ul>
            <div class="user-login-info">
              <a href="manageLogin.php?logout=1">登出</a>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <div style="margin: 30px 8px 20px 6px;border-top:1px dotted #C0C0C0;"></div>
  <h2 style="margin-left: 70px">Hi! <?= $managerName ?> 管理員，您希望對商品做什麼修改呢？</h2>

  <!-- ---------------------------------------以下開始為新增商品之程式碼------------------------------------------------ -->
  <div class="well">
    <button name="newProduct" id="newProduct" type="button" class="btn btn-success" data-toggle="collapse"
      data-target="#myCollapsible" aria-expanded="true" aria-controls="myCollapsible">新增
      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor"
        xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z">
        </path>
        <path fill-rule="evenodd"
          d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
        </path>
      </svg>
    </button>
  </div>

  <div id="myCollapsible" class="col-md-12 collapse" data-parent="#accordion">
    <div class="login-area add-mobile-gutter">
      <form class="ng-pristine ng-valid" enctype="multipart/form-data">
        <div class="login-form clearfix">

          <div class="form-title hidden-xs">商品名稱</div>
          <input type="text" name="productName" id="productName" tabindex="1" required>
          <div class="form-title hidden-xs">單價</div>
          <input type="number" name="unitPrice" id="unitPrice" tabindex="2" required>
          <div class="form-title hidden-xs">庫存量</div>
          <input type="number" name="unitsInStock" id="unitsInStock" tabindex="3" required>
          <div class="form-title hidden-xs">商品圖片</div>
          <input type="file" accept="image/*" name="productImageName" id="productImageName" tabindex="4" required>
          <div class="preview"><img id="newImage" src="" width="100" height="100"></div>

        </div>
        <button name="createProduct" id="createProduct" type="button" class="plain-btn -login-btn"
          tabindex="5">新增商品</button>
      </form>
    </div>
  </div>

  <div id="productTable">
    <table class="table table-striped version_5 href-tr" id="sortTable">
      <thead>
        <tr>
          <th scope="col">&nbsp;&nbsp;&nbsp;&nbsp;刪除 / 編輯</th>
          <th scope="col">商品縮圖</th>
          <th scope="col">商品名稱</th>
          <th scope="col">單價</th>
          <th scope="col">庫存量</th>
        </tr>
      </thead>
      <tbody id="productResult">
      </tbody>
    </table>
  </div>

  <!-- 對話盒 -->
  <div id="newsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2>修改商品資訊</h4>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="productNameBox" style="float: left">
                <span class="glyphicon glyphicon-tag"></span>
                商品名稱
              </label>
              <input type="text" id="productNameBox" class="form-control" placeholder="請輸入商品名稱">
            </div>

            <div class="form-group">
              <label for="unitPriceBox" style="float: left">
                <span class="glyphicon glyphicon-usd"></span>
                單價
              </label>
              <input type="text" id="unitPriceBox" class="form-control" placeholder="請輸入商品單價">
            </div>

            <div class="form-group">
              <label for="unitsInStockBox" style="float: left">
                <span class="glyphicon glyphicon-align-justify"></span>
                庫存量
              </label>
              <input type="text" id="unitsInStockBox" class="form-control" placeholder="請輸入商品目前的庫存量">
            </div>

            <div class="form-group">
              <label for="productImageBox" style="float: left">
                <span class="glyphicon glyphicon-align-justify"></span>
                商品圖片
              </label>
              <div class="preview"><img id="selectedImage" src="" width="100" height="100"></div>
              <input type="file" accept="image/*" id="productImageBox" class="form-control">
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <div class="pull-right">
            <button type="button" id="okButton" class="btn btn-success">
              <span class="glyphicon glyphicon-ok"></span> 確定
            </button>
            <button type="button" id="cancelButton" class="btn btn-default" data-dismiss="modal">
              <span class="glyphicon glyphicon-remove"></span> 取消
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /對話盒 -->

  <script>

    $(document).ready(function () {

      var productList =
        [
          { productID: "99999", productName: "test1", unitPrice: "100", unitsInStock: "20", productImageName: "img/productImage/123.jpg" },
          { productID: "88888", productName: "test2", unitPrice: "1000", unitsInStock: "2", productImageName: "img/productImage/456.jpg" }
        ];

      var currentIndex = -1; // 紀錄資料之索引值

      refreshProduct();

      // -----------------------------------------------------------> 更新資料庫中目前的商品
      function refreshProduct() {
        $("#productResult").empty(); // 清空產品資料
        $.ajax({
          type: 'GET', // 請求方法
          url: 'refreshProduct.php', // 請求網址
          async: true, // 異步請求
          cache: false, // 停止瀏覽器緩存加載
          dataType: 'json', // 返回資料類型

          beforeSend: function (jqXHR) { }, // 發送請求前執行
          success: function (data, textStatus, jqXHR) { }, // 成功後執行
          error: function (xhr, status, error) { }, // 失敗後執行
          complete: function (xhr, status, error) { }, // 完成後執行
        }).done(function (data, textStatus, jqXHR) { // 無論成功、失敗皆執行

          productList = data;

          var result = "";
          var editButton = '<span class="pull-left"><button class="btn btn-info btn-xs editItem"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>&nbsp;</span>';
          var removeButton = '<span class="pull-left"><button class="btn btn-danger btn-xs deleteItem"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>&nbsp;</span>';

          for (var i = 0; i < productList.length; i++) {
            var ls = productList[i];
            if (ls.productImageName === "") {
              ImageName = 'default.jpeg';
            }
            else {
              ImageName = ls.productImageName;
            }
            result = "<tr>" +
              '<th scope="col">' + removeButton + editButton + '</th>' +
              '<th scope="col">' + '<div class="preview"><img src="img/productImage/' + ImageName + '" width="100" height="100"></div>' + '</th>' +
              '<th scope="col">' + ls.productName + "</th>" +
              '<th scope="col">' + "$" + ls.unitPrice + "</th>" +
              '<th scope="col">' + ls.unitsInStock + "</th>" +
              "</tr>";
            $("#productResult").append(result);
          }
        });

        // 點按編輯商品的那支鉛筆
        $("#productResult").on("click", ".editItem", function () {
          var index = $(this).closest("tr").index();
          currentIndex = index; // 記錄該項目之索引

          if (productList[currentIndex].productImageName === "") {
            ImageName = 'default.jpeg';
          }
          else {
            ImageName = productList[currentIndex].productImageName;
          }

          $("#productNameBox").val(productList[currentIndex].productName);
          $("#unitPriceBox").val(productList[currentIndex].unitPrice);
          $("#unitsInStockBox").val(productList[currentIndex].unitsInStock);
          $("#selectedImage").attr("src", "img/productImage/" + ImageName);

          $("#newsModal").modal();
        });

        // 點按Ｘ刪除商品
        $("#productResult").on("click", ".deleteItem", function () {
          var index = $(this).closest("tr").index();
          currentIndex = index; // 記錄該項目之索引

          Swal.fire({
            title: "警告！",
            text: "確定要刪除這項商品資訊嗎？",
            showCancelButton: true
          }).then(function (result) {
            if (result.value) {
              Swal.fire("資料已刪除！");
              $.ajax({
                type: 'POST', // 請求方法
                url: 'deleteProduct.php', // 請求網址
                async: true, // 異步請求
                cache: false, // 停止瀏覽器緩存加載
                dataType: 'json', // 返回資料類型
                data: { // 傳送資料
                  "productID": productList[currentIndex].productID,
                },
              }).done(function (data, textStatus, jqXHR) { // 無論成功、失敗皆執行
                refreshProduct();
              });
            }
          });

        });

      }

      $("#productImageName").change(function () {
        readURL(this, "#newImage");
      });
      $("#productImageBox").change(function () {
        readURL(this, "#selectedImage");
      });

      function readURL(input, elementID) { // 商品圖片預覽功能
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $(elementID).attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
      }

      // 點擊確認修改商品資料
      $("#okButton").on("click", function () {
        Swal.fire({
          title: "修改",
          text: "確定要修改嗎？",
          showCancelButton: true
        }).then(function (result) {
          if (result.value) {

            var formData = new FormData();
            formData.append('productID', productList[currentIndex].productID);
            formData.append('productName', $("#productNameBox").val());
            formData.append('unitPrice', $("#unitPriceBox").val());
            formData.append('unitsInStock', $("#unitsInStockBox").val());
            formData.append('productImageName', $('#productImageBox')[0].files[0]);

            $.ajax({
              url: 'modifyProduct.php',
              type: 'POST',
              data: formData,
              contentType: false,
              processData: false,
              success: function (response) {
                Swal.fire("資料已更新！");
                refreshProduct();
                $("#newsModal").modal('hide');
              },
            });
            
          }
        });
      });

      // 新增商品
      $("#createProduct").on('click', function (e) {

        // 檢查商品名稱是否重複
        let duplicateName = 0;
        $.each(productList, function (index, value) {
          if ($("#productName").val() === value.productName) {
            duplicateName = 1;
          }
        });

        if (duplicateName === 0) {
          Swal.fire({
            title: "新增",
            text: "確定要新增該筆資料嗎？",
            showCancelButton: true
          }).then(function (result) {
            if (result.value) {

              var formData = new FormData();
              formData.append('productName', $("#productName").val());
              formData.append('unitPrice', $("#unitPrice").val());
              formData.append('unitsInStock', $("#unitsInStock").val());
              formData.append('productImageName', $('#productImageName')[0].files[0]);

              $.ajax({
                url: 'newProduct.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                  Swal.fire("資料已新增！");
                  refreshProduct();
                  $("#myCollapsible").collapse('hide');
                },
              });
            }
          });
        }
        else {
          Swal.fire({
            title: "警告",
            text: "商品名稱重複！",
          }).then(function (result) { });
        }
      });
    });

  </script>


  <!-- <script src="js/jquery/jquery-2.2.4.min.js"></script>
  <script src="js/bootstrap.min.js"></script> -->
  <script src="js/popper.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/classy-nav.min.js"></script>
  <script src="js/active.js"></script>

</body>

</html>