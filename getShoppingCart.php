<?php

session_start();
$userID = $_SESSION["userID"];

require_once("connectMysql.php");
$sqlCommand = "SELECT `shoppingCartID`, `productName`, `quantity`, `unitPrice` FROM `product` as P , 
(SELECT `shoppingCartID`, `productID`, `quantity` FROM `shoppingCart` WHERE `userID` = '$userID') 
as S WHERE S.productID = P.productID ORDER BY `shoppingCartID`";

$result = mysqli_query($link, $sqlCommand) or die(mysqli_error($link));

$dataarr = array();
while($row = mysqli_fetch_assoc($result)) {
    array_push($dataarr, $row);
}
echo json_encode($dataarr);

mysqli_close($link);
exit();

?>