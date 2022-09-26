<?php

include "connection.php";
$query = "SELECT id, category_title FROM categories WHERE id > 0";
$result = $conn->query($query);

$id = $_GET["id"];

$query2 = "SELECT category_id , category_name FROM product_category WHERE product_id = $id";
$result2 = $conn->query($query2);

include "header.php";
include "navigation.php";
?>


<div class="p-3 mb-3">
    <h1>Product</h1>
    <div class="p-3">
        <a href="productindex.php" class="btn btn-primary ">Back</a>
    </div>

    <div class="p-3 ">
        <h3>change product category</h3>
        <form action="update_product_category.php" method="post" enctype="multipart/form-data" >
            
    
            <div class="mb-3">
                <label for="category" class="form-label">Category</label> 
                <input type="text" name="id" value="<?php echo $_GET['id']; ?>" hidden>
                <p>previous selected :
                <?php
                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                            // print_r($row2);
                            echo  $row2["category_name"]."," ;
                        }
                    } 
                    ?>
                    </p>
                <select name="category[]" id="category" class="form-select form-select-sm js-example-basic-multiple-limit" aria-placeholder="select category">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["id"] . '">' . $row["category_title"] . '</option>';
                        }
                    } else {
                        echo "0 results";
                    }

                    ?>
            </div>
            <div class="mb-3">
                <input type="number" class="form-control d-none"  disabled>
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
    multiple : true 
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