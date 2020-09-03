<?php

$productName = $_POST["productName"]; // 接收ajax變數名稱
$unitPrice = $_POST["unitPrice"];
$unitsInStock = $_POST["unitsInStock"];

require_once("connectMysql.php");

// 將商品資料存進資料庫
$sqlCommand = "INSERT INTO `product` (`productName`, `unitPrice`, `unitsInStock`) 
VALUES ('$productName', '$unitPrice', '$unitsInStock')";
$result = mysqli_query($link, $sqlCommand) or die(mysqli_error($link));

mysqli_close($link);

exit();

?>