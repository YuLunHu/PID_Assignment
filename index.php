<?php 

session_start();
if (isset($_SESSION["nickName"])) // 判斷登入與否
  $nickName = $_SESSION["nickName"];
else 
  $nickName = "Guest"; // session中沒有使用者名稱即為Guest

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  <title>商品管理</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/style_ok.css">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</head>

<body>

  <header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">

      <nav class="classy-navbar" id="essenceNav">
        <a class="nav-brand" href="index.php"><img src="img/core-img/logo_plainB.png" alt=""></a>
        <div class="classy-navbar-toggler">
          <span class="navbarToggler"></span>
        </div>
        <div class="classy-menu">
          <div class="classycloseIcon">
            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
          </div>
          <div class="classynav">
            <ul>
              <li><a href="index.php">首頁</a></li>
              <li><a href="register.php">註冊</a></li>
              <li><?php if ($nickName == "Guest") { ?>
              <a href="login.php">登入</a>
              <?php } else { ?>
              <a href="login.php?logout=1">登出</a>
              <?php } ?></li>
            </ul>
          </div>
        </div>
      </nav>

      
    </div>
  </header>

  <div style="margin: 30px 8px 20px 6px;border-top:1px dotted #C0C0C0;"></div>

  <h2 style="margin-left: 70px">Hi! <?= $nickName ?> , 祝您有美好的一天</h2>


  <div id="productTable">
    <table class="table table-striped version_5 href-tr" id="sortTable">
      <thead>
        <tr>
          <th scope="col">商品縮圖</th>
          <th scope="col">商品名稱</th>
          <th scope="col">單價</th>
          <th scope="col">購買</th>
        </tr>
      </thead>
      <tbody id="productResult">
      </tbody>
    </table>
  </div>

  <!-- ------------------------------------以下為Js語法------------------------------------------->
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
          var shoppingCart = '<span class="pull-left"><button class="btn btn-info btn-xs editItem"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>&nbsp;</span>';
          
          for (var i = 0; i < productList.length; i++) {
            var ls = productList[i];
            if (ls.productImageName === "") {
              ImageName = 'default.jpeg';
            }
            else {
              ImageName = ls.productImageName;
            }
            result = "<tr>" +
              '<th scope="col">' + '<div class="preview"><img src="img/productImage/' + ImageName + '" width="100" height="100"></div>' + '</th>' +
              '<th scope="col">' + ls.productName + "</th>" +
              '<th scope="col">' + "$" + ls.unitPrice + "</th>" +
              '<th scope="col">' + shoppingCart + "</th>" +
              "</tr>";
            $("#productResult").append(result);
          }
        });

        // 點按加入購物車
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

      }

    });

  </script>

  <script src="js/popper.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/classy-nav.min.js"></script>
  <script src="js/active.js"></script>

</body>

</html>