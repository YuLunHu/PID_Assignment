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

require_once("connectMysql.php");

// $sqlCommand = "SELECT `productName`, `unitPrice`, `unitsInStock` FROM `product`";
// $result = mysqli_query($link, $sqlCommand);


if (isset($_POST["createProduct"])) {
  $productName = $_POST["productName"];
  $unitPrice = $_POST["unitPrice"];
  $unitsInStock = $_POST["unitsInStock"];
  
  $sqlCommand = "INSERT INTO `product` 
  (`productName`, `unitPrice`, `unitsInStock`) VALUES ('$productName', '$unitPrice', '$unitsInStock')";
  $result = mysqli_query($link, $sqlCommand);
  
  if ($result) {
  
    echo "<script> alert('新增資料成功'); window.location = 'productManage.php' </script>";
  } else {
    die('Error: ' . mysql_error()); //如果sql執行失敗輸出錯誤
  }
}
// mysqli_close($link);


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
      <form method="post" class="ng-pristine ng-valid">
        <div class="login-form clearfix">

          <div class="form-title hidden-xs">商品名稱</div>
          <input type="text" name="productName" id="productName" tabindex="1" required>
          <div class="form-title hidden-xs">單價</div>
          <input type="number" name="unitPrice" id="unitPrice" tabindex="2" required>
          <div class="form-title hidden-xs">庫存量</div>
          <input type="number" name="unitsInStock" id="unitsInStock" tabindex="3" required>

        </div>
        <button name="createProduct" id="createProduct" type="submit" class="plain-btn -login-btn"
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
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <th scope="col" class="height-100"><?= $row['productName'] ?></th>
          <th scope="col"><?= $row['unitPrice'] ?></th>
          <th scope="col"><?= $row['unitsInStock'] ?></th>

        </tr>
        <?php } ?>
      </tbody>

    </table>
  </div>



  <script>

    


    // $(document).ready(function () {
    //   $("#newProduct").on('click', function () {
    //     var x = document.getElementById("balance");
    //     var y = document.getElementById("eye");
    //     var z = document.getElementById("eyeClosed");

    //     if (x.style.display === "none") {
    //       x.style.display = "block";
    //       y.style.display = "none";
    //       z.src = "img/core-img/eye.png";
    //     }
    //     else {
    //       x.style.display = "none";
    //       y.style.display = "block";
    //       z.src = "img/core-img/eye_closed.png";
    //     }
    //   });
    // });

  </script>


  <script src="js/jquery/jquery-2.2.4.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/classy-nav.min.js"></script>
  <script src="js/active.js"></script>

</body>

</html>