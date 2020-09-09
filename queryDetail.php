<?php

session_start();

$orderID = $_POST["orderID"];

require_once("connectMysql.php");

// 查出本次購買明細的ID, 商品名稱, 時價和數量
$sqlCommand = "SELECT P.productID, P.productName, O.currentPrice, O.quantity FROM 
`product` as P, `ordersDetail` as O where P.productID = O.productID AND O.orderID = '$orderID'";
$result = mysqli_query($link, $sqlCommand) or die(mysqli_error($link));

$dataarr = array();
while($row = mysqli_fetch_assoc($result)) {
    array_push($dataarr, $row);
}
echo json_encode($dataarr);

mysqli_close($link);

?>