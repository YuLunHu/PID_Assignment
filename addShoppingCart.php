<?php

session_start();

$userID = $_SESSION['userID'];
$userName = $_SESSION['userName'];
$productID = $_POST["productID"];
$quantity = $_POST["quantity"];

require_once("connectMysql.php");

// 將購物車資料更新至資料庫
$sqlCommand = "INSERT INTO `shoppingCart` (`userID`, `productID`, `quantity`) 
VALUES ('$userID', '$productID', '$quantity')";
mysqli_query($link, $sqlCommand) or die(mysqli_error($link));

// 查詢目前的購物車內資料有幾筆
$sqlCommand = "SELECT count(`productID`) FROM `shoppingCart` WHERE `userID` = '$userID'";
$result = mysqli_query($link, $sqlCommand) or die(mysqli_error($link));
$row = mysqli_fetch_assoc($result);

echo json_encode($row);

mysqli_close($link);


?>