<?php

$productID = $_POST["productID"];
$productName = $_POST["productName"]; // 接收ajax變數名稱
$unitPrice = $_POST["unitPrice"];
$unitsInStock = $_POST["unitsInStock"];
$filename = $_FILES['productImageName']['name'];

require_once("connectMysql.php");

// 將商品資料更新至資料庫
$sqlCommand = "UPDATE `product` SET `productName` = '$productName', `unitPrice`= '$unitPrice', 
`unitsInStock`= '$unitsInStock', `productImageName` = '$filename' WHERE `productID` = '$productID'";
mysqli_query($link, $sqlCommand) or die(mysqli_error($link));

mysqli_close($link);

/* 把圖片傳到指定目錄 */
$location = "img/productImage/".$filename;
$uploadOk = 1;
$imageFileType = pathinfo($location,PATHINFO_EXTENSION);

/* Valid Extensions */
$valid_extensions = array("jpg","jpeg","png");
/* Check file extension */
if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
   $uploadOk = 0;
}

if($uploadOk == 0){
   echo 0;
}else{
   /* Upload file */
   if(move_uploaded_file($_FILES['productImageName']['tmp_name'],$location)){
      echo $location;
   }else{
      echo 0;
   }
}

?>