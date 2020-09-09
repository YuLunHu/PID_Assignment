<?php

require_once("connectMysql.php");

$userID = $_POST["userID"];
$status = $_POST["status"];

$sqlCommand = "UPDATE `userAccountInfo` SET `accountStatus` = '$status' WHERE `userID` = '$userID'";

mysqli_query($link, $sqlCommand) or die(mysqli_error($link));

mysqli_close($link);
exit();

?>
