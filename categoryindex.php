<?php

include "connection.php";
$query = "SELECT * FROM categories WHERE id > 0";
$result = $conn->query($query);

$query2 = "SELECT id, category_title FROM categories WHERE  parant_id = '0' AND id > 0";
$result2 = $conn->query($query2);

$conn->close();

include "header.php";
include "navigation.php";
?>
<div class="p-3 mb-3">
    <h1>Category</h1>
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
        <a href="category.php" class="btn btn-primary ">Add Category</a>
    </div>

    <div class="p-3 ">

        <div>
            <table border="2" class="table display dataTable" id='empTable'>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Category_title</th>
                        <th scope="col">Category_img</th>
                        <th scope="col">Description</th>
                        <th scope="col">Sort No</th>
                        <th scope="col">Parant Category</th>
                        <th scope="col">Action</th>

                </thead>
                <tbody>

                    <?
                    include "connection.php";
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr></tr><td>" . $row["id"] . "</td> " .
                                "<td>" . $row["category_title"] . " </td>" .
                                "<td> <img src = '".$main_imagepath . $row["category_img"] . "' height='80px' width='120px' class='img-fluid d-none d-md-block rounded mb-2 shadow ' ></td>" .
                                "<td>" . $row["description"] . "</td>" .
                                "<td>" . $row["sort_no"] . "</td>" .
                                "<td>";
                            $p_id = $row['parant_id'];
                            $query3 = "SELECT category_title FROM categories WHERE id = $p_id";
                            $result3 = $conn->query($query3);
                            if ($result3->num_rows > 0) {
                                while ($row3 = $result3->fetch_assoc()) {
                                    echo $row3["category_title"];
                                }
                            }
                            echo ' </td><td><a href="edit_category.php?id='. $row["id"] .' "><i class="fas fa-edit"></i></a> ,  <a onclick="return confirm(\'Are you delete this category?\');" href="delete_category.php?id='. $row["id"] .' "><i class="fa-solid fa-trash-can"></i></a></td> </tr>';
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