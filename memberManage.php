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

  <title>會員管理</title>
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
  <h2 style="margin-left: 70px">Hi , 管理員 <?= $managerName ?>， 以下是所有的會員</h2>
  <div style="margin: 30px 8px 20px 6px;border-top:1px dotted #C0C0C0;"></div>

  <div id="productTable">
    <table class="table table-striped version_5 href-tr" id="sortTable">
      <thead>
        <tr>
          <th scope="col" style="text-align: center">&nbsp;&nbsp;&nbsp;&nbsp;accountStatus</th>
          <th scope="col" style="text-align: center">userID</th>
          <th scope="col" style="text-align: center">userName</th>
          <th scope="col" style="text-align: center">nickName</th>
          <th scope="col" style="text-align: center">phoneNumber</th>
          <th scope="col" style="text-align: center">e-mail</th>
        </tr>
      </thead>
      <tbody id="memberResult">
      </tbody>
    </table>
  </div>

  <script>

    $(document).ready(function () {
      getMemberData();

      $("#productResult").on("click", ".availableBtn", function () {
        
      });

      function getMemberData() {
        $.ajax({
          url: 'queryAllMember.php',
          type: 'GET',
          contentType: false,
          processData: false,
          success: function (response) {
            memberList = JSON.parse(response);

            var availableBtn = '<button class="btn btn-info btn-xs availableBtn"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>';
            var forbidBtn = '<button class="btn btn-danger btn-xs forbidBtn"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';
            
            for (var i = 0; i < memberList.length; i++) {
              if (memberList[i].accountStatus == 1) {
                result = '<tr><td style="text-align: center">' + availableBtn +
                '</td><td style="text-align: center">' + memberList[i].userID +
                '</td><td style="text-align: center">' + memberList[i].userName +
                '</td><td style="text-align: center">' + memberList[i].nickName +
                '</td><td style="text-align: center">' + memberList[i].phoneNumber +
                '</td><td style="text-align: center">' + memberList[i].email +
                '</td><</tr>';
              }
              else {
                result = '<tr><td style="text-align: center">' + forbidBtn +
                '</td><td style="text-align: center">' + memberList[i].userID +
                '</td><td style="text-align: center">' + memberList[i].userName +
                '</td><td style="text-align: center">' + memberList[i].nickName +
                '</td><td style="text-align: center">' + memberList[i].phoneNumber +
                '</td><td style="text-align: center">' + memberList[i].email +
                '</td><</tr>';
              }
              
              $("#memberResult").append(result);
            }
            Swal.fire("資料已更新！");
          },
        });
      }





    })


  </script>

  <!-- <script src="js/jquery/jquery-2.2.4.min.js"></script>
  <script src="js/bootstrap.min.js"></script> -->
  <script src="js/popper.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/classy-nav.min.js"></script>
  <script src="js/active.js"></script>

</body>

</html>