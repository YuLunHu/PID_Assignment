<?php

session_start();

$shoppingCartID = $_POST["shoppingCartID"];

echo json_encode($shoppingCartID);
// require_once("connectMysql.php");

// $sqlCommand = "DELETE FROM `shoppingCart` WHERE `productID` = '$productID'";

// mysqli_query($link, $sqlCommand) or die(mysqli_error($link));

// mysqli_close($link);

?>