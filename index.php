<?php
    include "header.php";
    include("connection.php");

    $_SESSION['cart']=array();
    $error = "";

    //get data from post 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $myemail = mysqli_real_escape_string($conn, $_POST['email']);
        $mypassword = mysqli_real_escape_string($conn, $_POST['password']);

        $sql = "SELECT id FROM users WHERE email = '$myemail' and password = '$mypassword'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        // $active = $row['active'];

        $count = mysqli_num_rows($result);

        if ($count == 1) {
            //  session_register("myemail");
            
            $_SESSION['login_id'] = $myemail;

            header("location: product_list.php");
        } else {
            $error = "Your Login Name or Password is invalid";
            // header("location: login.php");
        }
    }


    $conn->close();
    ?>

    <div class="p-3 mb-3">
        <div>

            <h1>Login plaese</h1>
            <a href="ragister.php" class="btn btn-primary float-right btn-m" >Ragister Here!</a>
            
        </div>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="login_form" method="post" onsubmit="return validate()" >
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email">

            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <div class="mb-3">
                <div>
                    <p><?php echo $error; ?></p>
                </div>
                <!-- <label for="error" class="form-label"><?php echo $error; ?></label> -->

            </div>
        </form>

    </div>
    <script>    
        function validate() {    
            
            var email = document.login_form.email;    
            var password = document.login_form.password;    
         
            if (email.value.length <= 0) {    
                alert("Email Id is required");    
                email.focus();    
                return false;    
            }    
            if (password.value.length <= 0) {    
                alert("pasword is required");    
                password.focus();    
                return false;    
            }       
        }    
    </script>    

<?php
    include "footer.php";
?>