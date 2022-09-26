<?php

include "connection.php";

$id = $_GET["id"];

$query = "SELECT image_name FROM product_images  WHERE product_id = $id";
$result = $conn->query($query);

include "header.php";
include "navigation.php";
?>


<div class="p-3 mb-3">
    <h1>Product</h1>
    <div class="p-3">
        <a href="productindex.php" class="btn btn-primary ">Back</a>
    </div>

    <div class="p-3 ">
        <h3>change product images</h3>
        <form action="update_product_images.php" method="post" enctype="multipart/form-data">


            <div class="mb-3">
                <label for="category" class="form-label">Images previous selected :</label>
                <input type="text" name="id" value="<?php echo $_GET['id']; ?>" hidden>
                
                <?php
                
                if ($result->num_rows > 0) {
                    while ($row3 = $result->fetch_assoc()) {
                        echo "<img src = '". $product_image_path.$row3["image_name"] . "' height='80px' width='120px' > ,";
                    }
                } else {
                    echo "no images";
                }

                ?>
            </div>
           
            <div class="input-group mb-3">

                <label for="product_img">Upload image :</label>
                <div>
                    <input type="file" name="product_img[]" class="product_img" multiple>
                </div>
               
            </div>
    </div>
    <div class="mb-3">
        <input type="number" class="form-control d-none" disabled>
    </div>



    <input type="submit" class="btn btn-primary" value="submit" name="submit">

    </form>
</div>




</div>
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $("#category").select2({
        multiple: true
    });
    $("#category").select2({
        maximumSelectionLength: 2
    });

    $('select').select2({
        placeholder: 'select any two category',
        allowClear: true
    });

    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
<?php
include "footer.php";
?>