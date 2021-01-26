<div class="top-bar animate-dropdown" style="background-color: #f44336">
    <div class="container">
        <div class="header-top-inner">
            <div class="cnt-account" style="float:right; color: white">
                <ul class="list-unstyled" >
                    <?php if(strlen($_SESSION['login']))
    {   ?>
                    <li><a href="#"><i class="icon fa fa-user"></i>Welcome  <?php echo ($_SESSION['username']);?></a></li>
                    <?php } ?>
                    <li><a href="my-account.php"><i class="icon fa fa-user"></i> Account</a></li>
                    <li><a class="top-header-links" href="my-wishlist.php"><i class="icon fa fa-heart"></i>Wishlist</a></li>
                    <li><a href="my-cart.php"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
                    <?php if(strlen($_SESSION['login'])==0)
    {   ?>
                    <li><a href="login.php"><i class="icon fa fa-sign-in"></i>Login</a></li>
                    <?php }
else{ ?>
                    <li><a href="logout.php"><i class="icon fa fa-sign-out"></i>Logout</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>