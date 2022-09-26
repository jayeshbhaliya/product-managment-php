<?php


include "connection.php";

$query = "SELECT * FROM products ";
$result = $conn->query($query);


$conn->close();

include "header.php";
include "navigation.php";


?>
<div>
    <div class="container py-5">
        <div class="row text-center  mb-5">
            <div class="col-lg-7 mx-auto">
                <h1>Product List</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <!-- List group-->
                <ul class="list-group shadow">
                    <!-- list group item-->
                    <?php
                    include "connection.php";

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <li class="list-group-item" style="background-color: #e6f0ff;">
                                <!-- Custom content-->
                                <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                                    <div class="media-body order-2 order-lg-1">
                                        <h5 class="mt-0 font-weight-bold mb-2"><a href="product_detail.php?id=<?php echo $row["id"]; ?>"><?php echo $row["product_title"]; ?></a></h5>
                                        <p class=" text-muted mb-0 "><b><?php echo $row["short_desc"]; ?></b></p>
                                        <p class="font-italic text-muted mb-0 small"><?php echo $row["long_desc"]; ?></p>
                                        <div class="colors category">Category:
                                            <?php
                                            include "connection.php";
                                            $id = $row["id"];
                                            $query2 = "SELECT category_name FROM product_category  WHERE product_id = $id";
                                            $result2 = $conn->query($query2);
                                            if ($result2->num_rows > 0) {
                                                while ($row2 = $result2->fetch_assoc()) {
                                                    echo '<p class="btn bg-info m-1">' . $row2["category_name"] . '</p>';
                                                }
                                            } else {
                                                echo "no";
                                            }
                                            ?>

                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-1">
                                            <h6 class="font-weight-bold my-2">₹<?php echo $row["price"]; ?>/- ( <span style="text-decoration:line-through">₹<?php echo $row['unit_price']; ?>/-</span> )</h6>

                                        </div>
                                    </div>
                                    <?php
                                    include "connection.php";
                                    $query3 = "SELECT image_name FROM product_images  WHERE product_id = $id LIMIT 1" ;
                                    $result3 = $conn->query($query3);
                                    
                                
                                    if ($result3->num_rows > 0) {
                                        while ($row3 = $result3->fetch_assoc()) {
                                            
                                            echo '<img src="'.$product_image_path . $row3["image_name"] . '" width="280" height="200" class="ml-lg-5 order-1 order-lg-2  d-none d-md-block rounded mb-2 shadow" >';
                                            
                                        }
                                        
                                    }


                                    ?>
                                    
                                </div> <!-- End -->
                                <hr>
                            </li> <!-- End -->
                            <!-- list group item-->
                    <?php
                        }
                    }
                    ?>

                </ul> <!-- End -->
            </div>
        </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php
include "footer.php";
?>