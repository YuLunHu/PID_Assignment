<?php

// 啟動與mysql連結
$link = @mysqli_connect("localhost", "root", "root", null, 8889) or die(mysqli_connect_error()); // 若是XAMPP就沒有密碼
mysqli_query($link, "set names utf8");
mysqli_select_db($link, "plainB_DB");

?>