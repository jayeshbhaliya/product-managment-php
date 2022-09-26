
<div class="">
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary py-3">
        <a class="navbar-brand text-center text-white" href="#">Product Managment</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav " >
                <li class="nav-item active">
                    <a class="nav-link text-center text-white" href="product_list.php"> <i class="fas fa-duotone fa-house"> </i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center text-white" href="categoryindex.php">Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center text-white" href="productindex.php">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center text-white" href="cart.php"> <i class="fas fa-regular fa-cart-shopping"></i> Cart</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-center text-white" href="#"><i class="fas fa-solid fa-user"></i> <?php echo $_SESSION['login_id'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center text-white " onclick="return confirm('Are you sure to logout?');" href="logout.php"><i class="fas fa-regular fa-right-from-bracket"></i> Logout</a>
                </li>
                

            </ul>
        </div>
    </nav>
</div>