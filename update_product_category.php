<?php
include("connection.php");
session_start();

if(isset($_POST['submit'])) {
        $product_id = $_POST['id']; 
        $query2 = "DELETE FROM product_category WHERE product_id = $product_id";
            if ($conn->query($query2) === TRUE) {
                echo "delete previous";
            }
        foreach ($_POST['category'] as $selectedOption){
            $query = "SELECT category_title FROM categories WHERE id = $selectedOption";
            $result = $conn->query($query);
    
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $category_name = $row["category_title"];
                }
            } else {
                $category_name = null;
            }

            echo $selectedOption." ".$category_name."<br>";
             
            $query3 = "INSERT INTO product_category ( category_id , category_name, product_id) VALUES ('$selectedOption' ,'$category_name' , '$product_id' ) ";
            if ($conn->query($query3) === TRUE) {
                $massage = "Product category changed.";
                header("Location: productindex.php?massage={$massage}");
               
            } 
            else {
                $massage = "Error: " . $query3 . "<br>" . $conn->error;
                header("Location: productindex.php?massage={$massage}");
            }  
        } 

}

?>
