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

  <title>結帳</title>
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
  <div align="center">
    <h2>購物車清單</h2>
  </div>


  <div id="shoppingTable">
    <table class="table table-striped version_5 href-tr" id="sortTable">
      <thead>
        <tr>
          <th scope="col">商品名稱</th>
          <th scope="col" style="text-align: center">單價</th>
          <th scope="col" style="text-align: center">數量</th>
          <th scope="col" style="text-align: center">金額</th>
        </tr>
      </thead>
      <tbody id="shoppingCartResult">
      </tbody>
    </table>
  </div>

  <div style="margin: 30px 8px 20px 6px;border-top:1px dotted #C0C0C0;"></div>

  <div align="center"><button class="btn btn-primary" id="checkout">下單</button></div>


  <script>

    var formData = new FormData();
    let shoppingCartList = 0;

    $.ajax({
      url: 'getShoppingCart.php',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        shoppingCartList = JSON.parse(response);
        let total = 0;
        for (var i = 0; i < shoppingCartList.length; i++) {
          var amount = shoppingCartList[i].unitPrice * shoppingCartList[i].quantity;
          result = '<tr><td>' + shoppingCartList[i].productName +
            '</td><td style="text-align: center">$ ' + shoppingCartList[i].unitPrice +
            '</td><td style="text-align: center">' +
            '<input class="quantityItem" min="0" style="text-align: center;width:40px;" type="number" value="' +
            shoppingCartList[i].quantity + '" size="3" style="text-align: center">' +
            '</td><td style="text-align: center">$ ' + amount + '</td></tr>';
          $("#shoppingCartResult").append(result);
          total += amount;
        }
        result = '<tr><td></td><td></td><td style="text-align:right"><font size="3">小計:</font></td><td style="text-align: center"><font size="3">$ ' + total + '</font></td></tr>';
        $("#shoppingCartResult").append(result);
      },
    });

    $("#checkout").on("click", function () {
      Swal.fire({
        title: "提醒",
        text: "確定要下單了嗎？",
        showCancelButton: true
      }).then(function (result) {
        if (result.value) {

          // －－－－－－－－－－－－－－－－－－－－－－－－調整商品購買數量（測試中）－－－－－－－－－－－－－－－－－－－－－－
          // let quantityItem = $(".quantityItem");
          // console.log(quantityItem);
          // for (var i = 0; i < quantityItem.length; i++) {
          //   console.log(quantityItem[i].val());
          // }
          // －－－－－－－－－－－－－－－－－－－－－－－－調整商品購買數量（測試中）－－－－－－－－－－－－－－－－－－－－－－

          let total = 0;
          for (var i = 0; i < shoppingCartList.length; i++) {
            var shoppingData = new FormData();
            var amount = shoppingCartList[i].unitPrice * shoppingCartList[i].quantity;
            total += amount;

            shoppingData.append('shoppingCartID', shoppingCartList[i].shoppingCartID);
            shoppingData.append('quantity', shoppingCartList[i].quantity);

            if (i == (shoppingCartList.length - 1)) {
              shoppingData.append('total', total);
            }

            $.ajax({
              url: 'checkout.php',
              type: 'POST',
              data: shoppingData,
              contentType: false,
              processData: false,
              success: function (response) {
                console.log(JSON.parse(response));
              },
            });
          }
          // document.location.href = "orderDetail.php";
        }
      });

    });


  </script>


  <script src="js/popper.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/classy-nav.min.js"></script>
  <script src="js/active.js"></script>

</body>

</html>