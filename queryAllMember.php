<?php

session_start();

require_once("connectMysql.php");

$sqlCommand = "SELECT * FROM `userAccountInfo`";

$result = mysqli_query($link, $sqlCommand) or die(mysqli_error($link));

$dataarr = array();
while($row = mysqli_fetch_assoc($result)) {
    array_push($dataarr, $row);
}
echo json_encode($dataarr);

mysqli_close($link);
exit();

?>