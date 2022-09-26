<?php


include "connection.php";
$id = $_GET["id"];
$query = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}

$conn->close();

include "header.php";
include "navigation.php";
// $_SESSION["cart"] = $_SESSION["cart"];
?>
<link rel="stylesheet" href="css1.css">
<div class="card">
    <div class="container-fliud">
        <div class="wrapper row">
            <div class="preview col-md-6">

                <div class="preview-pic tab-content">
                    <?php
                    include "connection.php";
                    $query3 = "SELECT image_name FROM product_images  WHERE product_id = $id";
                    $result3 = $conn->query($query3);
                    $result4 = $conn->query($query3);
                    $i = 1;
                        if ($result3->num_rows > 0) {
                            while ($row3 = $result3->fetch_assoc()) {
                                echo '<div class="tab-pane ';
                                if($i == 1){
                                    echo "active";
                                }
                                echo '" id="pic-'.$i.'"><img src="'.$product_image_path.$row3["image_name"] . '" width="400px" height="350px" /></div>';
                                $i++;
                               
                            }
                            echo '</div class= "center"><ul class="preview-thumbnail nav nav-tabs">';
                            $j = 1;
                            // print_r($result3->fetch_assoc());
                            while ($row4 = $result4->fetch_assoc()) {
                
                                echo '<li><a data-target="#pic-'.$j.'" data-toggle="tab"><img src="'.$product_image_path.$row4["image_name"] . '" /></a></li>';
                                $j++;
                               
                            }
                            echo ' </ul>';
                        } 

                        
                    ?>
                    
                

            </div>
            <div class="details col-md-6">
                <h3 class="product-title"><?php echo $row['product_title']; ?> </h3>

                <p class="product-short-description"><?php echo $row['short_desc']; ?></p>
                <h4 class="price">current price: <span>₹<?php echo $row['price']; ?>/-</span></h4>
                <h5 class="price">Regular price: <span style="text-decoration:line-through">₹<?php echo $row['unit_price']; ?>/-</span></h3>

                    <h5 class="colors category">Category:
                        <?php
                        include "connection.php";
                        $query2 = "SELECT category_name FROM product_category  WHERE product_id = $id";
                        $result2 = $conn->query($query2);
                        if ($result2->num_rows > 0) {
                            while ($row2 = $result2->fetch_assoc()) {
                                echo '<span class="btn bg-info">' . $row2["category_name"] . '</span> , ';
                            }
                        } else {
                            echo "no";
                        }
                        ?>

                    </h5>
                    <div class="product-description"> <?php echo $row['long_desc']; ?> </div>
                    <!-- <input type="button" class="btn addToCart btn-primary" value="Add to cart"> -->
                    <button class="btn addToCart btn-primary" ><i class="fas fa-duotone fa-cart-arrow-down" onclick="addtocart()" >  Add to cart </i></button>

            </div>
        </div>
    </div>
</div>
<script>
    function addtocart(){
        <?php 
        if(in_array($id,$_SESSION["cart"])){
            echo "alert('Item already in cart')";
            // exit();
        } else{
            array_push($_SESSION["cart"],$id);
            echo "alert('Add to cart succsessfully!!')";

        }
        ?>
    }

</script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<?php
include "footer.php";
?>

