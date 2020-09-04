<?php

$productID = $_POST["productID"];

require_once("connectMysql.php");

// 將商品資料更新至資料庫
$sqlCommand = "DELETE FROM `product` WHERE `productID` = '$productID'";
mysqli_query($link, $sqlCommand) or die(mysqli_error($link));

mysqli_close($link);

echo "1";
exit();

?>