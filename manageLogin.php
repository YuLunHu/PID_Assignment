<?php 
// ------------------------------------管理端頁面----------------------------------------------
session_start();
if (isset($_GET["logout"])) // 判斷是否有收到logout的值
{
  unset($_SESSION["managerName"]); // 若有則代表管理員登出，將session清除

  echo "<script> alert('登出成功，即將為您跳轉回登入頁'); window.location='manageLogin.php' </script>";
	exit();
}

if (isset($_SESSION["managerName"])) {
  echo "<script> alert('您已登入，即將為您跳轉回管理首頁'); window.location='manageIndex.php' </script>";
	exit();
}

if (isset($_POST["login"]))
{
  $managerName = $_POST["managerName"];
  $managerPassword = $_POST["managerPassword"];
	if (trim($managerName) != "" && trim($managerPassword) != "") // 去除前後的空白，判斷使用者名稱和密碼是否為空字串
	{
    require_once("connectMysql.php");
    $sqlCommand = "SELECT * FROM managerAccount where managerName = '$managerName'";
    $result = mysqli_query($link, $sqlCommand);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($link);

    if ($row['managerName'] == $managerName && password_verify($managerPassword, $row['managerPassword'])) { // 判斷帳號密碼是否正確
      $_SESSION['managerName'] = $managerName; // 將管理者名稱存入session
      echo "<script> alert('登入成功，即將為您跳轉至管理端首頁'); window.location = 'manageIndex.php' </script>";
    }
  }
  else {
    echo "<script> alert('帳號或密碼不可為空') </script>";
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style_ok.css" rel="stylesheet">
  <link rel="stylesheet" href="css/core-style.css">
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <title>管理者登入</title>
</head>

<body>

  <header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
      <img style="margin:auto;display:block;" src="img/core-img/logo_plainB.png" alt="">
    </div>
  </header>


  <div class="col-md-12 text-center">
    <h2>系統管理員登入</h2>
  </div>

  <div class="col-md-12">
    <div class="login-area add-mobile-gutter">
      <form method="post" class="ng-pristine ng-valid">
        <div class="login-form clearfix">
          <div class="form-title hidden-xs">帳號</div>
          <input type="text" name="managerName" id="managerName" tabindex="3" placeholder="請在此輸入帳號" autocomplete="on"
            required>
          <div class="form-title hidden-xs">密碼</div>
          <input type="password" name="managerPassword" id="managerPassword" tabindex="4" placeholder="請在此輸入密碼" required>
        </div>
        <?php if (isset($managerName) && isset($managerPassword)) { ?>
        <?php if (!($row['managerName'] == $managerName) || !(password_verify($managerPassword, $row['managerPassword']))) { ?>
        <div style="color: red;">您輸入的帳號或密碼錯誤！</div>
        <?php } }?>
        <button name="login" id="login" type="submit" class="plain-btn -login-btn" tabindex="5">登入</button>
      </form>
    </div>
  </div>
  
</body>

</html>