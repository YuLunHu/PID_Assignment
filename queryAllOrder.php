<?php

session_start();

if (isset($_POST["userID"])) {
    $userID = $_POST["userID"];
}
else {
    $userID = $_SESSION["userID"];
}

require_once("connectMysql.php");

// 查出本次明細
$sqlCommand = "SELECT `orderID`, `orderTime`, `orderAmount` FROM `orders` WHERE `userID` = '$userID' 
ORDER BY `orderTime` DESC";
$result = mysqli_query($link, $sqlCommand) or die(mysqli_error($link));

$dataarr = array();
while($row = mysqli_fetch_assoc($result)) {
    array_push($dataarr, $row);
}
echo json_encode($dataarr);
mysqli_close($link);

?>