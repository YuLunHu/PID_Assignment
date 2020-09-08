<?php

session_start();

$formData = $_POST["0"];
$new = $formData["shoppingCartID"];

echo json_encode($new);
// require_once("connectMysql.php");

// $sqlCommand = "DELETE FROM `shoppingCart` WHERE `productID` = '$productID'";

// mysqli_query($link, $sqlCommand) or die(mysqli_error($link));

// mysqli_close($link);

?>