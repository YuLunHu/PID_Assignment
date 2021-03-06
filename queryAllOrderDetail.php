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

  <title>歷史訂單明細</title>
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
              <li><?php if ($nickName == "Guest") { ?>
                <a></a>
                <?php } else { ?>
                <a href="queryAllOrderDetail.php">訂單明細</a>
                <?php } ?></li>
            </ul>
          </div>
        </div>
      </nav>


    </div>
  </header>

  <div style="margin: 30px 8px 20px 6px;border-top:1px dotted #C0C0C0;"></div>
  <div align="center">
    <h2><?= $nickName ?>, 這是您的訂單明細</h2>
  </div>



  <div id="orderTable">
    <table class="table table-striped version_5 href-tr" id="sortTable">
      <thead>
        <tr>
          <th scope="col" style="text-align: center"></th>
          <th scope="col" style="text-align: center">訂單時間</th>
          <th scope="col" style="text-align: center">總金額</th>
        </tr>
      </thead>
      <tbody id="orderResult">
      </tbody>
    </table>
  </div>

  <div style="margin: 30px 8px 20px 6px;border-top:1px dotted #C0C0C0;"></div>
  
</body>


<script>
  $(document).ready(function () {

    var order = queryOrder();

    $("#orderResult").on("click", ".spreadOrderDetail", function () {
      var index = $(this).closest("tr").index();
      currentIndex = index/2; // 記錄該項目之索引
      queryDetail(currentIndex);
    });

    function queryDetail(currentIndex) {
      var formData = new FormData();
      formData.append('orderID', order[currentIndex].orderID);

      $.ajax({
        url: 'queryDetail.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          detail = JSON.parse(response);
          var n = ".p" + String(currentIndex);
          $(n).html("");
          for (var i = 0; i < detail.length; i++) {
            productName = detail[i].productName;
            currentPrice = detail[i].currentPrice;
            quantity = detail[i].quantity;

            result = "商品名稱： " + productName + ", " +
            "單價： " + currentPrice + ", " +
            "數量： " + quantity + "<BR>";
            
            $(n).append(result);
          }
          $(n).slideToggle();
        },
      });
    }

    function queryOrder() {
      $("#orderResult").empty();
      let spreadButton = '<button name="newProduct" id="newProduct" type="button" ' +
        'class="btn btn-success spreadOrderDetail" data-toggle="collapse" data-target="#myCollapsible" ' +
        'aria-expanded="true" aria-controls="myCollapsible">展開<svg width="1em" ' +
        'height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" ' +
        'xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" ' +
        'd="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>' +
        '<path fill-rule="evenodd"d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 ' +
        '0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path></svg></button>';
      var ajaxOrder = $.ajax({
        url: 'queryAllOrder.php',
        type: 'GET',
        contentType: false,
        processData: false,
        success: function (response) {
          order = JSON.parse(response);
          for (var i = 0; i < order.length; i++) {
            result = '<tr><td style="text-align: center">' + spreadButton +
              '</td><td style="text-align: center">' + order[i].orderTime +
              '</td><td style="text-align: center">$ ' + order[i].orderAmount +
              '</td></tr>';
            details = '<p class="p' + i +'" style="display:none;text-align: center"></p>';
            $("#orderResult").append(result);
            $("#orderResult").append(details);
          }
          return order;
        },
      });
      return ajaxOrder;
    }

  });
</script>


<script src="js/popper.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/classy-nav.min.js"></script>
<script src="js/active.js"></script>

</body>

</html>