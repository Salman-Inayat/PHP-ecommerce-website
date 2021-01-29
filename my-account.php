<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:login.php');
} else {
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $contactno = $_POST['contactno'];
        $query = mysqli_query($con, "update users set name='$name',contactno='$contactno' where id='" . $_SESSION['id'] . "'");
        if ($query) {
            echo "<script>alert('Your info has been updated');</script>";
        }
    }

    if (isset($_POST['submit'])) {
        $sql = mysqli_query($con, "SELECT password FROM  users where password='" . md5($_POST['cpass']) . "' && id='" . $_SESSION['id'] . "'");
        $num = mysqli_fetch_array($sql);
        if ($num > 0) {
            $con = mysqli_query($con, "update students set password='" . md5($_POST['newpass']) . "' where id='" . $_SESSION['id'] . "'");
            echo "<script>alert('Password Changed Successfully !!');</script>";
        } else {
            echo "<script>alert('Current Password not match !!');</script>";
        }
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="keywords" content="MediaCenter, Template, eCommerce">
        <meta name="robots" content="all">

        <title>My Account</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.css">
        <link rel="stylesheet" href="assets/css/owl.transitions.css">

        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="assets/images/favicon.ico">
    </head>

    <body class="cnt-home">
        <header class="header-style-1">
            <?php include('includes/header.php'); ?>

        </header>


        <div class="body-content outer-top-bd">
            <div class="container">
                <div class="checkout-box inner-bottom-sm">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="panel-group checkout-steps" id="accordion">
                                <div class="panel panel-default checkout-step-01">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">
                                            <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                                                <span>1</span>My Profile
                                            </a>
                                        </h4>
                                    </div>

                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                <h4>Personal info</h4>
                                                <div class="col-md-12 col-sm-12 already-registered-login">

                                                    <?php
                                                    $query = mysqli_query($con, "select * from users where id='" . $_SESSION['id'] . "'");
                                                    while ($row = mysqli_fetch_array($query)) {
                                                    ?>

                                                        <form class="register-form" role="form" method="post">
                                                            <div class="form-group">
                                                                <label class="info-title" for="name">Name<span>*</span></label>
                                                                <input type="text" class="form-control unicase-form-control text-input" value="<?php echo $row['name']; ?>" id="name" name="name" required="required">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="info-title" for="Contact No.">Contact No.
                                                                    <span>*</span></label>
                                                                <input type="text" class="form-control unicase-form-control text-input" id="contactno" name="contactno" required="required" value="<?php echo $row['contactno']; ?>" maxlength="10">
                                                            </div>
                                                            <button type="submit" name="update" class="btn-upper btn btn-primary checkout-page-button">Update</button>
                                                        </form>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php include('includes/myaccount-sidebar.php'); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include('includes/footer.php'); ?>

        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/scripts.js"></script>

    </body>

    </html>
<?php } ?>