<?php
include("connection.php");
session_start();

if (isset($_POST['submit'])) {
    $product_id = $_POST['id'];
    $upload_dir = '../product_managment/product_images/' . DIRECTORY_SEPARATOR;
    $allowed_types = array('jpg', 'png', 'jpeg', 'gif');


    if (!empty(array_filter($_FILES['product_img']['name']))) {
        $query2 = "DELETE FROM product_images WHERE product_id = $product_id";
        if ($conn->query($query2) === TRUE) {
            echo "delete previous";
        }
        foreach ($_FILES['product_img']['tmp_name'] as $key => $value) {

            $file_tmpname = $_FILES['product_img']['tmp_name'][$key];
            $file_name = $_FILES['product_img']['name'][$key];
            $file_name = str_replace(' ', '-', $file_name);
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $filepath = $upload_dir . $file_name;

            if (in_array(strtolower($file_ext), $allowed_types)) {

                if (move_uploaded_file($file_tmpname, $filepath)) {
                    $sql = "INSERT INTO product_images ( image_name , product_id ) VALUES ('$file_name', '$product_id' )";
                    if ($conn->query($sql) === TRUE) {
                        $massage = "Product image change successfully ! ";
                        header("Location: productindex.php?massage={$massage}");
                    } else {
                        $massage = "Error: " . $sql . "<br>" . $conn->error;
                        header("Location: productindex.php?massage={$massage}");
                    }
                } else {
                    $massage = "Error uploading {$file_name} <br />";
                    header("Location: productindex.php?massage={$massage}");
                }
            } else {
                echo "Error uploading {$file_name} ";
                $massage = "({$file_ext} file type is not allowed)<br / >";
                header("Location: productindex.php?massage={$massage}");
            }
        }
    } else {
        echo "No product_img selected.";
        $massage = "No product image selected and added successfully. ";
        header("Location: productindex.php?massage={$massage}");
    }
}
