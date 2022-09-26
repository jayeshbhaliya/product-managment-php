<?php

include "connection.php";
$query = "SELECT * FROM products ";
$result = $conn->query($query);
$conn->close();
include "header.php";
include "navigation.php";
?>

<div class="p-3 md-3">
    <h1>Products</h1>
    <?php
    if($_GET){

        $massage = $_GET['massage'];
          if($massage){
            echo '<div class="massage alert alert-success alert-dismissible fade show" role="alert"><strong>';
            echo $massage;
            echo '</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
          }
    }
    ?>
    
         
    <div class="p-3">
        <a href="product.php" class="btn btn-primary ">Add Product</a>
    </div>
    <div class="p-3">
        <div>
            <table border="2" class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Short Description</th>
                        <th scope="col">Long Description</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Price</th>
                        <th scope="col">Categories</th>
                        <th scope="col">images</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include "connection.php";

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $this_product_id = $row["id"];
                            $query2 = "SELECT category_name FROM product_category  WHERE product_id = $this_product_id";
                            $result2 = $conn->query($query2);

                            $query3 = "SELECT image_name FROM product_images  WHERE product_id = $this_product_id";
                            $result3 = $conn->query($query3);


                            echo "<tr><td>" . $row["id"] . "</td> " .
                                "<td>" . $row["product_title"] . " </td>" .
                                "<td>" . $row["short_desc"] . "</td>" .
                                "<td>" . $row["long_desc"] . "</td>" .
                                "<td>" . $row["unit_price"] . "</td>" .
                                "<td>" . $row["stock"] . "</td>" .
                                "<td>" . $row["discount"] . " ( " . $row["discount_type"] . " ) " . "</td>" .
                                "<td>" . $row["price"] . "</td><td>";

                            if ($result2->num_rows > 0) {
                                while ($row2 = $result2->fetch_assoc()) {
                                    echo "" . $row2["category_name"] . " , ";
                                }
                            } else {
                                echo "no";
                            }
                            echo "</td> ";
                            echo "<td> ";
                            if ($result3->num_rows > 0) {
                                while ($row3 = $result3->fetch_assoc()) {
                                    echo "<img src = '".$product_image_path . $row3["image_name"] . "' height='50px' width='50px' > ,";
                                }
                            } else {
                                echo "no images";
                            }
                            echo ' </td>';
                            echo '<td><a  href="edit_product.php?id=' . $row["id"] . ' "><i class="fas fa-edit"></i></a> , <a onclick="return confirm(\'Are you delete this product?\');" href="delete_product.php?id=' . $row["id"] . ' "> <i class="fa-solid fa-trash-can"></i></a>, <a  href="product_detail.php?id=' . $row["id"] . ' "><i class="fas fa-duotone fa-eye"></i></a></td></tr>';

                            
                        }
                    } else {
                        echo "0 results";
                    }

                    ?>
            </table>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>