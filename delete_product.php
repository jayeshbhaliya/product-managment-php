<?php
include("connection.php");
session_start();
if(count($_GET)>0) {
    $id = $_GET["id"];
    $query = "DELETE FROM products WHERE id= $id ";
    $result = $conn->query($query);

    $query2 = "DELETE FROM product_images WHERE product_id= $id ";
    $result2 = $conn->query($query2);

    $query3 = "DELETE FROM product_category WHERE product_id= $id ";
    $result3 = $conn->query($query3);
    
    $conn->close();
    $massage = "Product deleted Successfully";
    header("Location: productindex.php?massage={$massage}");
}
	
?>