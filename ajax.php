<?php

$productName = $_POST["productName"]; // 接收ajax變數名稱
$unitPrice = $_POST["unitPrice"];
$unitsInStock = $_POST["unitsInStock"];

require_once("connectMysql.php");

// // $sqlCommand = "SELECT `productName`, `unitPrice`, `unitsInStock` FROM `product`";
// // $result = mysqli_query($link, $sqlCommand); // 這邊是抓資料庫回來顯示的語法


$sqlCommand = "INSERT INTO `product` (`productName`, `unitPrice`, `unitsInStock`) 
VALUES ('$productName', '$unitPrice', '$unitsInStock')";

$result = mysqli_query($link, $sqlCommand);
if ($result) {
    echo "<script> alert('新增資料成功'); window.location = 'productManage.php' </script>";
} else {
    die('Error: ' . mysql_error()); //如果sql執行失敗輸出錯誤
}

mysqli_close($link);

echo "$productName<BR>" . "$unitPrice<BR>" . "$unitsInStock";　// 取值使用echo而不是return

?>