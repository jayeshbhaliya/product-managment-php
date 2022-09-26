<?php
include("connection.php");
session_start();

if(isset($_POST['submit'])) {
    $product_title = $_POST['product_title'];
    $short_desc = $_POST['short_desc'];
    $product_desc = $_POST['product_desc'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $discount = $_POST['discount'];

	
	$upload_dir = '../product_managment/product_images/'.DIRECTORY_SEPARATOR;
	$allowed_types = array('jpg', 'png', 'jpeg', 'gif');
	
    $sql = "INSERT INTO products ( `product_title`, `short_desc`, `long_desc`, `price`, `stock`, `discount`) VALUES ('$product_title', '$short_desc' ,'$product_desc', '$price', '$stock' , '$discount')";

    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
       
    } else{
        $lastproductId = $conn->insert_id;  


        if(!empty(array_filter($_FILES['product_img']['name']))) {
            foreach ($_FILES['product_img']['tmp_name'] as $key => $value) {
                
                $file_tmpname = $_FILES['product_img']['tmp_name'][$key];
                $file_name = $_FILES['product_img']['name'][$key];
                $file_name = str_replace(' ', '-',$file_name);
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $filepath = $upload_dir.time().$file_name;
    
                if(in_array(strtolower($file_ext), $allowed_types)) {
    
                        if( move_uploaded_file($file_tmpname, $filepath)) {
                            $sql2 = "INSERT INTO product_images ( image_name , product_id ) VALUES ('$file_name', '$lastproductId' )";
                            if ($conn->query($sql2) === TRUE) {
                                header("Location: product.php");
                            } 
                            else {
                                echo "Error: " . $sql2 . "<br>" . $conn->error;
                            }   
                        }
                        else {					
                            echo "Error uploading {$file_name} <br />";
                        }
                    
                }
                else {
                    echo "Error uploading {$file_name} ";
                    echo "({$file_ext} file type is not allowed)<br / >";
                }
            }
        }
        else {
            echo "No product_img selected.";
        }


    }
   

	
}

?>
