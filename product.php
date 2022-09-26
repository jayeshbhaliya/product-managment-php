<?php

include "connection.php";
$query = "SELECT id, category_title FROM categories WHERE id > 0";
$result = $conn->query($query);
?>
<?php
include "header.php";
include "navigation.php";
?>


<div class="p-3 mb-3">
    <h1>Product</h1>
    <div class="p-3">
        <a href="productindex.php" class="btn btn-primary ">Back</a>
    </div>

    <div class="p-3 ">
        <h3>Add Product</h3>
        <form action="add_product.php" method="post" enctype="multipart/form-data" name="product_form" onsubmit="return validate()" >
            <div class="mb-3">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" class="form-control" id="product_title" name="product_title">

            </div>

            <div class="mb-3">
                <label for="short_desc" class="form-label">Short Description</label>
                <input type="text" class="form-control" id="short_desc" name="short_desc">

            </div>
           
            <div class="mb-3">
                <label for="product_desc" class="form-label">Description</label>
              
                <!-- <div id="editor"> -->
                <textarea class="form-control" id="editor" name="product_desc" rows="4"></textarea>
            
                <!-- </div> -->
            </div>
            <div class="mb-3">
                <label for="unit_price" class="form-label">Unit Price</label>
                <input type="number" class="form-control" id="unit_price" name="unit_price">
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock">
            </div>

            <div class="mb-3">
                <label for="discount_type" class="form-label">Discount Type</label>
                <select name="discount_type" id="discount_type" class="form-control test">
                    <option value="fixed" >Fixed</option>
                    <option value="percentage">Percentage</option>
            </div>
            <div class="mb-3">
                <input type="number" class="form-control d-none"  disabled>
            </div>
            <div class="mb-3">
                <label for="discount" class="form-label">Discount</label>
                <input type="number" class="form-control " id="discount" name="discount" >
            </div>

            <div id="more_img">
                <div class="input-group mb-3">

                    <label for="product_img">Upload image :</label>
                    <div>
                        <input type="file" name="product_img[]" class="product_img" multiple>
                    </div>
                    <!-- <input type="button" value="+" class="btn btn-primary " id="add_more_img">
                        <input type="button" value="-" class="btn btn-danger " class="remove_img"> -->
                </div>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="category[]" id="category" class="form-select form-select-sm js-example-basic-multiple-limit" aria-placeholder="select category">
                    <?
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
    function validate() {    
            
            var product_title = document.product_form.product_title;
            var short_desc = document.product_form.short_desc;    
            var product_desc = document.product_form.product_desc;
            var unit_price = document.product_form.unit_price;
            var stock = document.product_form.stock;    
            var discount = document.product_form.discount;
            
            
         
            if (product_title.value.length <= 0) {    
                alert("Title is required");    
                product_title.focus();    
                return false;    
            } 
            if (short_desc.value.length <= 0) {    
                alert("Short description is required");    
                short_desc.focus();    
                return false;    
            }
            if (product_desc.value.length <= 0) {    
                alert("Description is required");    
                product_desc.focus();    
                return false;    
            }
            if (unit_price.value.length <= 0) {    
                alert("Unit Price is required");    
                unit_price.focus();    
                return false;    
            } 
            if (stock.value.length <= 0) {    
                alert("Stock is required");    
                stock.focus();    
                return false;    
            }
            if (discount.value.length <= 0) {    
                alert("Discount is required");    
                discount.focus();    
                return false;    
            } 
            
             
        }   


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