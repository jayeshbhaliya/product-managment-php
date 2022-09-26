<?php
include("connection.php");
session_start();

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $product_title = $_POST['product_title'];
    $short_desc = $_POST['short_desc'];
    $product_desc = $_POST['product_desc'];
    $unit_price = $_POST['unit_price'];
    $stock = $_POST['stock'];
    $discount = $_POST['discount'];
    $discount_type = $_POST['discount_type'];

    if($discount_type == 'fixed'){
      $price = $unit_price - $discount ;
    }
    elseif($discount_type == 'percentage' ){
       $price = (100 -$discount)*$unit_price/100;
    }
	
    $sql = "UPDATE products SET product_title = '$product_title', short_desc = '$short_desc' , long_desc = '$product_desc' , unit_price = '$unit_price'  , stock = '$stock' , discount = '$discount' , discount_type = '$discount_type' , price = '$price' WHERE id = '$id' ";
      

    if ($conn->query($sql) === TRUE) {
        $massage = "Updated successfully";
        header("Location: productindex.php?massage={$massage}");
        
    } 
    else{
        $massage = "Error: " . $sql . "<br>" . $conn->error;
        header("Location: productindex.php?massage={$massage}");
    }	
}
