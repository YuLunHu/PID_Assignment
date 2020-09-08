<?php 

session_start();
if (isset($_GET["logout"])) // 判斷是否有收到logout的值
{
  unset($_SESSION["userName"]); // 若有則代表使用者登出，將session清除
  unset($_SESSION["nickName"]);
  unset($_SESSION["userID"]);

  echo "<script> alert('登出成功，即將為您跳轉回首頁'); window.location='index.php' </script>";
	exit();
}

if (isset($_POST["login"]))
{
  $UserName = $_POST["userName"];
  $Password = $_POST["userPassword"];
	if (trim($UserName) != "" && trim($Password) != "") // 去除前後的空白，判斷使用者名稱和密碼是否為空字串
	{
    require_once("connectMysql.php");
    $sqlCommand = "SELECT * FROM userAccountInfo where userName = '$UserName'";
    $result = mysqli_query($link, $sqlCommand);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($link);

    if ($row['userName'] == $UserName && password_verify($Password, $row['userPassword'])) { // 判斷帳號密碼是否正確
      $_SESSION['userName'] = $UserName; // 將使用者名稱存入session
      $_SESSION['nickName'] = $row['nickName'];
      $_SESSION['userID'] = $row['userID'];
      echo "<script> alert('登入成功，即將為您跳轉至首頁'); window.location = 'index.php' </script>";
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
  <title>plain-B 會員登入</title>
</head>

<body>

  <header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
      <nav class="classy-navbar" id="essenceNav">
        <a class="nav-brand" href="index.php"><img src="img/core-img/logo_plainB.png" alt=""></a>
        <div class="classy-navbar-toggler">
          <span class="navbarToggler"><span></span><span></span><span></span></span>
        </div>
        <div class="classy-menu">
          <div class="classycloseIcon">
            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
          </div>
          <div class="classynav">
            <ul>
              <li><a href="index.php">首頁</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <div style="margin: 30px 8px 20px 6px;border-top:1px dotted #C0C0C0;"></div>

  <div class="col-md-12 text-center">
    <h2>plain-B 會員登入</h2>
  </div>

  <div class="col-md-12">
    <div class="login-area add-mobile-gutter">
      <form method="post" class="ng-pristine ng-valid">
        <div class="login-form clearfix">
          <div class="form-title hidden-xs">帳號</div>
          <input type="text" name="userName" id="userName" tabindex="3" placeholder="請在此輸入帳號" autocomplete="on"
            required>
          <div class="form-title hidden-xs">密碼</div>
          <input type="password" name="userPassword" id="userPassword" tabindex="4" placeholder="請在此輸入密碼" required>
        </div>
        <?php if (isset($UserName) && isset($Password)) { ?>
        <?php if (!($row['userName'] == $UserName) || !(password_verify($Password, $row['userPassword']))) { ?>
        <div style="color: red;">您輸入的帳號或密碼錯誤！</div>
        <?php } }?>
        <button name="login" id="login" type="submit" class="plain-btn -login-btn" tabindex="5">登入</button>
      </form>
    </div>
  </div>

  <div class="col-md-12 text-center">
    <h4>還不是會員嗎？<a class="link-center" href="register.php"><u>註冊新帳號</u></a></h4>
  </div>

</body>

</html>