<?php

include "connection.php";


$query = "SELECT * FROM categories WHERE id > 0";
$result = $conn->query($query);

$query2 = "SELECT id, category_title FROM categories WHERE  parant_id = '0' AND id > 0";
$result2 = $conn->query($query2);
$id = $_GET["id"];
$query3 = "SELECT * FROM categories WHERE id = $id";
$result3 = $conn->query($query3);
if ($result3->num_rows > 0) {
    $row3 = $result3->fetch_assoc();
    
}

$conn->close();

include "header.php";
include "navigation.php";
?>

<div class="p-3 mb-3">
    <h1>Category</h1>
    <div class="p-3">
        <a href="categoryindex.php" class="btn btn-primary ">Back</a>
    </div>
    <div class="p-3 ">
   
        <h3>Edit Category</h3>

        <form action="update_category.php" method="post" enctype="multipart/form-data" name="cat_form" onsubmit="return validate()" >
        
            <div class="mb-3">
                <label for="category_title" class="form-label">Category Title</label>
                <input type="text" name="id" value="<?php echo $id ?>" hidden>
                <input type="text" class="form-control" id="category_title" name="category_title" value="<?php echo $row3["category_title"] ?>">

            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="<?php echo $row3["description"] ?>">

            </div>
            <div class="mb-3">
                <label for="sort_no">Sort Number</label>
                <input type="number" class="form-control" id="sort_no" name="sort_no" value="<?php echo $row3["sort_no"] ?>">

            </div>
            <div class="mb-3">
                <label for="parant_id">Parant Category</label>
                <select name="parant_id" id="parant_id" class="form-select form-select-sm">
                    <option value="0" selected>No parant</option>

                    <?
                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                            echo '<option value="' . $row2["id"] . '">' . $row2["category_title"] . '</option>';
                        }
                    } else {
                        echo "0 results";
                    }

                    ?>

                </select>

            </div>

            <div class="input-group mb-3">
                <label for="category_img">Upload image : </label>
                <input type="file" name="category_img" id="category_img" name="category_img" >
                <img src="<?php echo $main_imagepath.$row3["category_img"] ?>" alt="" height="80px" width="120px">
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>




</div>
<script>
    function validate() {    
            
            var category_title = document.cat_form.category_title;
            var description = document.cat_form.description;    
            var sort_no = document.cat_form.sort_no;
            var category_img = document.cat_form.category_img;
            
         
            if (category_title.value.length <= 0) {    
                alert("Title is required");    
                category_title.focus();    
                return false;    
            } 
            if (description.value.length <= 0) {    
                alert("Description is required");    
                description.focus();    
                return false;    
            }
            if (sort_no.value.length <= 0) {    
                alert("Short number is required");    
                sort_no.focus();    
                return false;    
            } 
            if (sort_category_imgno.value.length <= 0) {    
                alert("Image is required");    
                category_img.focus();    
                return false;    
            }
             
        }
     ClassicEditor.create( document.getElementById("product_desc") );
        // ClassicEditor
        // .create( document.getElementById("product_desc") )
        // .catch( error => {
        //     console.error( error );
        // } );
</script>



<?php
include "footer.php";
?>