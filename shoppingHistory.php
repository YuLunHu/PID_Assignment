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
$userID = $_GET['id'];
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title>特定會員的購物紀錄</title>
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
          <span class="navbarToggler"><span></span><span></span><span></span></span>
        </div>
        <div class="classy-menu">
          <div class="classycloseIcon">
            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
          </div>
          <div class="classynav">
            <ul>
              <li><a href="productManage.php">商品管理</a></li>
              <li><a href="memberManage.php">會員管理</a></li>
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
  <h2 style="margin-left: 70px">Hi , 管理員 <?= $managerName ?>，這是“<?= $userID ?>”購買過的商品</h2>
  <div style="margin: 30px 8px 20px 6px;border-top:1px dotted #C0C0C0;"></div>



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

      var formData = new FormData();
      var userID = '<?php echo $userID ?>';
      formData.append('userID', userID);

      var ajaxOrder = $.ajax({
        url: 'queryAllOrder.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          // console.log(response);
          order = JSON.parse(response);
          for (var i = 0; i < order.length; i++) {
            result = '<tr><td style="text-align: center">' + spreadButton +
              '</td><td style="text-align: center">' + order[i].orderTime +
              '</td><td style="text-align: center">$ ' + order[i].orderAmount +
              '</td></tr>';
            details = '<p class="p' + i + '" style="display:none"></p>';
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