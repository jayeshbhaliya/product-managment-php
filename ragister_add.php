<?php
session_start();
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $email = $_POST['email'];
  $name = $_POST['name'];
  $number = $_POST['number'];
  $address = $_POST['address'];
  $password = $_POST['password'];
}

$sql = "INSERT INTO users ( email, name, number, address, password)
VALUES ('$email', '$name', '$number', '$address','$password')";

if ($conn->query($sql) === TRUE) {
  // session_register("user");

  $_SESSION['login_id'] = $email;
  $_SESSION['login_name'] = $name;
  header("Location: product_list.php");
  
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
