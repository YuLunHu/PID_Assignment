<?php

require_once("connectMysql.php");

$sqlCommand = "SELECT `productName`, `unitPrice`, `unitsInStock`, `productImageName` FROM `product`";
$result = mysqli_query($link, $sqlCommand);

$dataarr = array();
while($row = mysqli_fetch_assoc($result)) {
    array_push($dataarr, $row);
}

echo json_encode($dataarr);

mysqli_close($link);
exit();

?>