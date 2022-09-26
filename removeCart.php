<?php

session_start();

if($_GET){
    echo "hello";
    $id = $_GET['id'];
  
    $cartarr = $_SESSION['cart'];
    $key = array_search($id, $cartarr);
  
    unset($_SESSION["cart"][$key]);
   
    header("Location: cart.php");
    
}
