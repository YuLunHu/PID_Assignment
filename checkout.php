<?php

session_start();

$currentPrice = $_POST["unitPrice"];
$quantity = $_POST["quantity"];
$orderAmount = $_POST["total"];
$userID = $_SESSION["userID"];
$shoppingCartID = $_POST["shoppingCartID"];

require_once("connectMysql.php");

// 新增訂單資料
if (isset($_POST["total"])) {
    $datetime = date("Y-m-d H:i:s", mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y')));
    $sqlCommand = "INSERT INTO `orders` (`userID`, `orderTime`, `orderAmount`) VALUES ('$userID', '$datetime' ,'$orderAmount')";
    mysqli_query($link, $sqlCommand) or die(mysqli_error($link));
}

// 查出剛剛新增的訂單ID
$sqlCommand = "SELECT MAX(`orderID`) AS `lastOrderID`  FROM `orders`";
$result = mysqli_query($link, $sqlCommand) or die(mysqli_error($link));
$row = mysqli_fetch_assoc($result);
$orderID = $row['lastOrderID'];
$_SESSION["orderID"] = $orderID;

// 查出本次明細要新增的商品ID
$sqlCommand = "SELECT `productID` FROM `shoppingCart` WHERE `shoppingCartID` = '$shoppingCartID'";
$result = mysqli_query($link, $sqlCommand) or die(mysqli_error($link));
$row = mysqli_fetch_assoc($result);
$productID = $row['productID'];

// 新增訂單明細
$sqlCommand = "INSERT INTO `ordersDetail` (`orderID`, `productID`, `currentPrice`, `quantity`) VALUES 
('$orderID', '$productID', '$currentPrice', '$quantity')";
mysqli_query($link, $sqlCommand) or die(mysqli_error($link));

// 清除購物車中的資料
$sqlCommand = "DELETE FROM `shoppingCart` WHERE `shoppingCartID` = '$shoppingCartID'";
mysqli_query($link, $sqlCommand) or die(mysqli_error($link));

mysqli_close($link);


?>