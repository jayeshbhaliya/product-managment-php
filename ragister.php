<?php
    include "header.php";
?>
    <div class="p-3 mb-3">
        <h1>Ragister plaese</h1>
        <a href="index.php" class="btn btn-primary right" >Login Here!</a>
       
        <form action="ragister_add.php"name="reg_form" method="post" onsubmit="return validate()">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email">

            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="name" class="form-control" id="name" name="name">

            </div>
            <div class="mb-3">
                <label for="number" class="form-label">Number</label>
                <input type="number" class="form-control" id="number" name="number">

            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address">

            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>    
        function validate() {    
            
            var email = document.reg_form.email;
            var name = document.reg_form.name;    
            var number = document.reg_form.number;
            var address = document.reg_form.address;      
            var password = document.reg_form.password;    
         
            if (email.value.length <= 0) {    
                alert("Email Id is required");    
                email.focus();    
                return false;    
            } 
            if (name.value.length <= 0) {    
                alert("Name is required");    
                name.focus();    
                return false;    
            }
            if (number.value.length <= 0) {    
                alert("number is required");    
                number.focus();    
                return false;    
            } 
            if(address.value.length <=0 ){
                alert ("Address is require");
                address.focus();
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