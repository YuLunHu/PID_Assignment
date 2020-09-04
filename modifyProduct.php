<?php

$productID = $_POST["productID"];
$productName = $_POST["productName"]; // 接收ajax變數名稱
$unitPrice = $_POST["unitPrice"];
$unitsInStock = $_POST["unitsInStock"];

require_once("connectMysql.php");

// 將商品資料更新至資料庫
$sqlCommand = "UPDATE `product` SET `productName` = '$productName', `unitPrice`= '$unitPrice', 
`unitsInStock`= '$unitsInStock' WHERE `productID` = '$productID'";
mysqli_query($link, $sqlCommand) or die(mysqli_error($link));

mysqli_close($link);

echo "1";
exit();

?>