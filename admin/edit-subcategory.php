<?php
session_start();
error_reporting(0);
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['submit'])) {
        $category = $_POST['category'];
        $subcat = $_POST['subcategory'];
        $id = intval($_GET['id']);
        $sql = mysqli_query($con, "update subcategory set categoryid='$category',subcategory='$subcat' where id='$id'");
        $_SESSION['msg'] = "Sub-Category Updated!";
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin| Edit SubCategory</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/admin-style.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    </head>

    <body>
        <?php include('include/header.php'); ?>

        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <?php include('include/sidebar.php'); ?>
                    <div class="span9">
                        <div class="content">
                            <div class="module">
                                <div class="module-head">
                                    <h3>Edit SubCategory</h3>
                                </div>
                                <div class="module-body">
                                    <?php if (isset($_POST['submit'])) { ?>
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <?php echo ($_SESSION['msg']); ?><?php echo ($_SESSION['msg'] = ""); ?>
                                        </div>
                                    <?php } ?>
                                    <form class="form-horizontal row-fluid" name="Category" method="post">
                                        <?php
                                        $id = intval($_GET['id']);
                                        $query = mysqli_query($con, "select category.id,category.categoryName,subcategory.subcategory from subcategory join category on category.id=subcategory.categoryid where subcategory.id='$id'");
                                        while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                            <div class="control-group">
                                                <label class="control-label" for="basicinput">Category</label>
                                                <div class="controls">
                                                    <select name="category" class="span8 tip" required>
                                                        <option value="<?php echo ($row['id']); ?>">
                                                            <?php echo ($catname = $row['categoryName']); ?></option>
                                                        <?php $ret = mysqli_query($con, "select * from category");
                                                        while ($result = mysqli_fetch_array($ret)) {
                                                            echo $cat = $result['categoryName'];
                                                            if ($catname == $cat) {
                                                                continue;
                                                            } else {
                                                        ?>
                                                                <option value="<?php echo $result['id']; ?>">
                                                                    <?php echo $result['categoryName']; ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="basicinput">SubCategory Name</label>
                                                <div class="controls">
                                                    <input type="text" placeholder="Enter category Name" name="subcategory" value="<?php echo ($row['subcategory']); ?>" class="span8 tip" required>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="control-group">
                                            <div class="controls">
                                                <button type="submit" name="submit" class="btn  btn-danger">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
<?php } ?>