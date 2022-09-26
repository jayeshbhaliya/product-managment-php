<?php
include("connection.php");
session_start();
if(count($_GET)>0) {
    $id = $_GET["id"];
    $query = "DELETE FROM categories WHERE id= $id ";
    $result = $conn->query($query);

    $query2 = "DELETE FROM product_category WHERE product_id= $id ";
    $result2 = $conn->query($query2);

    $conn->close();
    $massage = "category deleted Successfully";
    header("Location: categoryindex.php?massage={$massage}");
}
	
?>
