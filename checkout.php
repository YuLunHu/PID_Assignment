<?php

session_start();

$shoppingCartID = $_POST["shoppingCartID"];
$quantity = $_POST["quantity"];

echo json_encode($quantity);
// require_once("connectMysql.php");

// $sqlCommand = "DELETE FROM `shoppingCart` WHERE `productID` = '$productID'";

// mysqli_query($link, $sqlCommand) or die(mysqli_error($link));

// mysqli_close($link);

?>