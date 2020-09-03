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

  <link rel="stylesheet" href="css/core-style.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="css/style_ok.css">
  <script src="js/bootstrap.min.js"></script>
</head>

<body>

  <header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">

      <nav class="classy-navbar" id="essenceNav">
        <a class="nav-brand" href="manageIndex.php"><img src="img/core-img/logo_plainB.png" alt=""></a>
        <div class="classy-navbar-toggler">
          <span class="navbarToggler"><span></span><span></span><span></span></span>
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
          </div>
        </div>
      </nav>

      <div class="header-meta d-flex clearfix justify-content-end">
        <div class="search-area">
          <div style="float: right;">
            <div class="user-login-info">
              <a href="manageLogin.php?logout=1">登出</a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </header>

  <div style="margin: 30px 8px 20px 6px;border-top:1px dotted #C0C0C0;"></div>
  <h2 style="margin-left: 70px">Hi! <?= $managerName ?> 管理員，您希望對商品做什麼修改呢？</h2>

  <!-- ---------------------------------------以下開始為新增商品之程式碼------------------------------------------------ -->

  <div class="well">
    <button name="newProduct" id="newProduct" type="button" class="btn btn-outline-primary" data-toggle="collapse"
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

  <div id="myCollapsible" class="col-md-12 collapse show" data-parent="#accordion">
    <div class="login-area add-mobile-gutter">
      <form class="ng-pristine ng-valid">
        <div class="login-form clearfix">

          <div class="form-title hidden-xs">商品名稱</div>
          <input type="text" name="productName" id="productName" tabindex="1" required>
          <div class="form-title hidden-xs">單價</div>
          <input type="number" name="unitPrice" id="unitPrice" tabindex="2" required>
          <div class="form-title hidden-xs">庫存量</div>
          <input type="number" name="unitsInStock" id="unitsInStock" tabindex="3" required>

        </div>
        <button name="createProduct" id="createProduct" type="button" class="plain-btn -login-btn"
          tabindex="4">新增商品</button>
      </form>
    </div>
  </div>

  <div id="productTable">
    <table class="table table-striped version_5 href-tr" id="sortTable">

      <thead>
        <tr>
          <th scope="col" class="height-100">商品名稱</th>
          <th scope="col">單價</th>
          <th scope="col">庫存量</th>
        </tr>
      </thead>

      <tbody id="productResult">
        <tr>
          <th scope="col" class="height-100">1</th>
          <th scope="col">2</th>
          <th scope="col">3</th>
        </tr>
      </tbody>

    </table>
  </div>

  <div id="akacodedog">尚未執行</div>

  <script>

    $(document).ready(function () {
      $("#createProduct").on('click', function (e) {
        let productName = $("#productName").val();
        let unitPrice = $("#unitPrice").val();
        let unitsInStock = $("#unitsInStock").val();

        $.ajax({
          type: 'post', // 請求方法
          url: 'ajax.php', // 請求網址
          async: true, // 異步請求
          cache: false, // 停止瀏覽器緩存加載
          dataType: 'html', // 返回資料類型
          data: { // 傳送資料
            "productName": productName,
            "unitPrice": unitPrice,
            "unitsInStock": unitsInStock
          },
          beforeSend: function (jqXHR) { }, // 發送請求前執行
          success: function (data, textStatus, jqXHR) { }, // 成功後執行
          error: function (xhr, status, error) { }, // 失敗後執行
          complete: function (xhr, status, error) { }, // 完成後執行
        }).done(function (data, textStatus, jqXHR) { // 無論成功、失敗皆執行
          // $('#akacodedog').html(data); // 把結果輸出到#akacodedog容器
        });
      });
    });


  </script>


  <script src="js/jquery/jquery-2.2.4.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/classy-nav.min.js"></script>
  <script src="js/active.js"></script>

</body>

</html>