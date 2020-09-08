<?php 

session_start();
if (isset($_SESSION["nickName"])) // 判斷登入與否
  $nickName = $_SESSION["nickName"];
else {
    $nickName = "Guest"; // session中沒有使用者名稱即為Guest
    echo "<script> alert('請先登入'); top.location='login.php';</script>";
}
  

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>訂單明細</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/style_ok.css">
  <link rel="stylesheet" href="css/shoppingCart.css">

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

  <div align="center"><h2>訂單明細</h2></div>


  <div id="shoppingTable">
    <table class="table table-striped version_5 href-tr" id="sortTable">
      <thead>
        <tr>
          <!-- <th scope="col">選項</th> -->
          <th scope="col">商品名稱</th>
          <th scope="col">單價</th>
          <th scope="col">數量</th>
          <th scope="col">金額</th>
        </tr>
      </thead>
      <tbody id="shoppingCarttResult">
      </tbody>
    </table>
  </div>

  <div style="margin: 30px 8px 20px 6px;border-top:1px dotted #C0C0C0;"></div>




  <script>

    var formData = new FormData();
    $.ajax({
      url: 'getShoppingCart.php',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        let shoppingCartList = JSON.parse(response);
        let total = 0;

        for (var i = 0; i < shoppingCartList.length; i++) {

          var amount = shoppingCartList[i].unitPrice * shoppingCartList[i].quantity;
          result = '<tr><td>' + shoppingCartList[i].productName +
            '</td><td>$ ' + shoppingCartList[i].unitPrice +
            '</td><td>' + shoppingCartList[i].quantity +
            ' 件</td><td>$ ' + amount + '</td></tr>';
          $("#shoppingCarttResult").append(result);
          total += amount;
        }
        result = '<tr><td></td><td></td><td>小計:</td><td>$ ' + total + '</td></tr>';
        $("#shoppingCarttResult").append(result);
      },
    });



  </script>


  <script src="js/popper.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/classy-nav.min.js"></script>
  <script src="js/active.js"></script>

</body>

</html>