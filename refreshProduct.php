<?php

require_once("connectMysql.php");

// 再將目前的商品列表抓出來
$sqlCommand = "SELECT `productName`, `unitPrice`, `unitsInStock` FROM `product`";
$result = mysqli_query($link, $sqlCommand); // 這邊是抓資料庫回來顯示的語法

$dataarr = array();
while($row = mysqli_fetch_assoc($result)) {
    array_push($dataarr, $row);
}

mysqli_close($link);
echo json_encode($dataarr);

exit();

?>