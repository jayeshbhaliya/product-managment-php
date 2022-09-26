<?php


include "connection.php";

$query = "SELECT * FROM products ";
$result = $conn->query($query);


$conn->close();

include "header.php";
include "navigation.php";

// print_r($_SESSION["cart"]);
$cartLength = sizeof($_SESSION['cart']);
$cart_session = $_SESSION['cart'];
// echo $cartLength;

?>
<section class="pt-5 pb-5">
    <div class="container">
        <div class="row w-100">
            <div class="col-lg-12 col-md-12 col-12">
                <h3 class="display-5 mb-2 text-center">Shopping Cart</h3>
                <p class="mb-5 text-center">
                    <i class="text-info font-weight-bold"><?php echo $cartLength; ?></i> items in your cart
                </p>
                <table id="shoppingCart" class="table table-condensed table-responsive">
                    <thead>
                        <tr>
                            <th style="width:60%">Product</th>
                            <th style="width:12%">Price</th>
                            <th style="width:10%">Quantity</th>
                            <th style="width:16%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "connection.php";
                        $subtotal = 0;
                        foreach ($_SESSION['cart'] as $item) {
                            $id = $item;

                            $query = "SELECT * FROM products WHERE id = $id";
                            $result = $conn->query($query);
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                            }
                            $query2 = "SELECT image_name FROM product_images  WHERE product_id = $id LIMIT 1";
                            $result2 = $conn->query($query2);
                            if ($result2->num_rows > 0) {
                                $row2 = $result2->fetch_assoc();
                            }
                        ?>
                            <tr>
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-md-3 text-left">
                                            <img src="<?php echo $product_image_path . $row2["image_name"]; ?>" alt="" class="img-fluid d-none d-md-block rounded mb-2 shadow ">
                                        </div>
                                        <div class="col-md-9 text-left mt-sm-2">
                                            <h4><?php echo $row['product_title']; ?></h4>
                                            <p class="font-weight-light"><?php echo $row['short_desc']; ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price">₹<?php echo $row['price']; ?>/-</td>
                                <td data-th="Quantity">
                                    <input type="number" class="form-control form-control-lg text-center" value="1" max="5" min="1">
                                </td>
                                <td class="actions" data-th="">
                                    <div class="text-right">
                                        <form action="removeCart.php">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <button class="btn btn-white border-secondary bg-white btn-md mb-2" type="submit">
                                                <i class="fas fa-trash"></i>

                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        <?php
                            $subtotal += $row['price'];
                        }
                        ?>
                    </tbody>
                </table>
                <div class="float-right text-right">
                    <h4>Subtotal:</h4>
                    <h1>₹<?php echo $subtotal; ?>/-</h1>
                </div>
            </div>
        </div>
        <div class="row mt-4 d-flex align-items-center">
            <div class="col-sm-6 order-md-2 text-right">
                <a href="#" class="btn btn-primary mb-4 btn-lg pl-5 pr-5">Checkout</a>
            </div>
            <div class="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-left">
                <a href="product_list.php">
                    <i class="fas fa-arrow-left mr-2"></i> Continue Shopping</a>
            </div>
        </div>
    </div>
</section>
<?php
include "footer.php";
?>