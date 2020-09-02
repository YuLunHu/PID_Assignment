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
  <link rel="stylesheet" href="css/core-style.css">
  <link rel="stylesheet" href="style.css">
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
  <h2 style="margin-left: 70px">Hi! <?= $managerName ?>  管理員，您希望對商品做些什麼修改呢？</h2>

  

  <script src="js/jquery/jquery-2.2.4.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/classy-nav.min.js"></script>
  <script src="js/active.js"></script>

</body>

</html>