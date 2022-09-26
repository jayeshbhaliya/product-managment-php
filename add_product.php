<?php
include("connection.php");
session_start();

if(isset($_POST['submit'])) {
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

    
   

	
	$upload_dir = '../product_managment/product_images/'.DIRECTORY_SEPARATOR;
	$allowed_types = array('jpg', 'png', 'jpeg', 'gif');
	
    $sql = "INSERT INTO products ( `product_title`, `short_desc`, `long_desc`, `unit_price`, `stock`, `discount`, `discount_type`, `price`) VALUES ('$product_title', '$short_desc' ,'$product_desc', '$unit_price', '$stock' , '$discount','$discount_type','$price')";

    if ($conn->query($sql) !== TRUE) {
        $massage = "Error: " . $sql . "<br>" . $conn->error;
        header("Location: productindex.php?massage={$massage}");
       
    } else{
        $lastproductId = $conn->insert_id; 
        foreach ($_POST['category'] as $selectedOption){
            $query3 = "SELECT category_title FROM categories WHERE id = $selectedOption";
            $result3 = $conn->query($query3);
    
            if ($result3->num_rows > 0) {
                while ($row = $result3->fetch_assoc()) {
                    $category_name = $row["category_title"];
                }
            } else {
                $category_name = null;
            }
            echo $selectedOption." ".$category_name."<br>";
            $query4 = "INSERT INTO product_category ( category_id , category_name, product_id) VALUES ('$selectedOption' ,'$category_name' , '$lastproductId' ) ";
            if ($conn->query($query4) === TRUE) {
                
                echo "success";
            } 
            else {
                $massage = "Error: " . $query4 . "<br>" . $conn->error;
                header("Location: productindex.php?massage={$massage}");
            }  
        } 


        if(!empty(array_filter($_FILES['product_img']['name']))) {
            foreach ($_FILES['product_img']['tmp_name'] as $key => $value) {
                
                $file_tmpname = $_FILES['product_img']['tmp_name'][$key];
                $file_name = $_FILES['product_img']['name'][$key];
                $file_name = str_replace(' ', '-',$file_name);
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $filepath = $upload_dir.$file_name;
    
                if(in_array(strtolower($file_ext), $allowed_types)) {
    
                        if( move_uploaded_file($file_tmpname, $filepath)) {
                            $sql2 = "INSERT INTO product_images ( image_name , product_id ) VALUES ('$file_name', '$lastproductId' )";
                            if ($conn->query($sql2) === TRUE) {
                                $massage = "Product successfully added ! ";
                                header("Location: productindex.php?massage={$massage}");
                            } 
                            else {
                                $massage = "Error: " . $sql2 . "<br>" . $conn->error;
                                header("Location: productindex.php?massage={$massage}");
                            }   
                        }
                        else {					
                            $massage = "Error uploading {$file_name} <br />";
                            header("Location: productindex.php?massage={$massage}");
                        }
                    
                }
                else {
                    echo "Error uploading {$file_name} ";
                    $massage = "({$file_ext} file type is not allowed)<br / >";
                    header("Location: productindex.php?massage={$massage}");
                }
            }
        }
        else {
            echo "No product_img selected.";
            $massage = "No product image selected and added successfully. ";
            header("Location: productindex.php?massage={$massage}");
        }


    }
   

	
}
