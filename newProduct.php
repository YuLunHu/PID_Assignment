<?php

$productName = $_POST["productName"];
$unitPrice = $_POST["unitPrice"];
$unitsInStock = $_POST["unitsInStock"];
$filename = $_FILES['productImageName']['name'];

require_once("connectMysql.php");

// 將商品資料存進資料庫
$sqlCommand = "INSERT INTO `product` (`productName`, `unitPrice`, `unitsInStock`, `productImageName`) 
VALUES ('$productName', '$unitPrice', '$unitsInStock', '$filename')";
mysqli_query($link, $sqlCommand) or die(mysqli_error($link));

mysqli_close($link);

/* Location */
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