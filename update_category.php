<?php
include("connection.php");
session_start();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST["id"];
    $category_title = $_POST['category_title'];
    $description = $_POST['description'];
    $sort_no = $_POST['sort_no'];
    $parant_id = $_POST['parant_id'];
    // $category_img = $_POST['category_img'];
 
    $target_dir = "../product_managment/image/";
    $file_basename = basename($_FILES["category_img"]["name"]);
    $file_basename = str_replace(' ', '-',$file_basename);
    $tempname = $_FILES["category_img"]["tmp_name"];  
    // echo $tempname;
    $target_file = $target_dir.$file_basename;
    
    
    
    $upload_ok = 0;
    $file_type  = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if($file_basename){
        echo " success";
        if(isset($_POST["submit"])){
            $check = getimagesize($tempname);
            if($check !== false){
                echo "File is an image - " . $check["mime"] . ".\n";
                $upload_ok = 1;
              }
            else{
                $massage =  "File is not image.";
                header("Location: categoryindex.php?massage={$massage}");
                $upload_ok = 0;
            }
        }
        if ($upload_ok == 0) {
            echo "Sorry, your file was not uploaded.";
          } 
          else {
            if (move_uploaded_file($tempname, $target_file)) {
              echo "The file ". htmlspecialchars($file_basename). " has been uploaded.";
      
              $sql = "UPDATE categories SET category_title = '$category_title', parant_id = '$parant_id' , description = '$description' , sort_no = '$sort_no' , category_img = '$file_basename'  WHERE id = '$id' ";
      
              if ($conn->query($sql) === TRUE) {
                $massage = "Updated successfully";
                header("Location: categoryindex.php?massage={$massage}");
              } 
              else {
                $massage =  "Error: " . $sql . "<br>" . $conn->error;
                header("Location: categoryindex.php?massage={$massage}");
              }
            } else {
              $massage = "Sorry, there was an error uploading your file.";
              header("Location: categoryindex.php?massage={$massage}");
            }
          }
    } else {

        $sql = "UPDATE categories SET category_title = '$category_title', parant_id = '$parant_id' , description = '$description' , sort_no = '$sort_no'   WHERE id = '$id' ";
      
              if ($conn->query($sql) === TRUE) {
               $massage = "Updated successfully";
                header("Location: categoryindex.php?massage={$massage}");
              } 
              else {
                $massage =  "Error: " . $sql . "<br>" . $conn->error;
                header("Location: categoryindex.php?massage={$massage}");
              }
       
    }


    $conn->close();

}

?>
