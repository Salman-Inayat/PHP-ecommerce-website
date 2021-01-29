<?php
session_start();
error_reporting(0);
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    $pid = intval($_GET['id']);
    if (isset($_POST['submit'])) {
        $category = $_POST['category'];
        $subcat = $_POST['subcategory'];
        $productname = $_POST['productName'];
        $productcompany = $_POST['productCompany'];
        $productprice = $_POST['productprice'];
        $productpricebd = $_POST['productpricebd'];
        $productdescription = $_POST['productDescription'];
        $productavailability = $_POST['productAvailability'];
        $sql = mysqli_query($con, "update  products set category='$category',subCategoroductny='$subcat',productName='$prame',productCompany='$productcompany',productPrice='$productprice',productDescription='$productdescription',productAvailability='$productavailability',productPriceBeforeDiscount='$productpricebd' where id='$pid' ");
        $_SESSION['msg'] = "Product Updated Successfully !!";
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin| Add Product</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/admin-style.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
        <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
        <script type="text/javascript">
            bkLib.onDomLoaded(nicEditors.allTextAreas);
        </script>

        <script>
            function getSubcat(val) {
                $.ajax({
                    type: "POST",
                    url: "get_subcat.php",
                    data: 'cat_id=' + val,
                    success: function(data) {
                        $("#subcategory").html(data);
                    }
                });
            }

            function selectCountry(val) {
                $("#search-box").val(val);
                $("#suggesstion-box").hide();
            }
        </script>


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
                                    <h3>Insert Product</h3>
                                </div>
                                <div class="module-body">
                                    <?php if (isset($_POST['submit'])) { ?>
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <?php echo ($_SESSION['msg']); ?><?php echo ($_SESSION['msg'] = ""); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if (isset($_GET['del'])) { ?>
                                        <div class="alert alert-error">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <?php echo ($_SESSION['delmsg']); ?><?php echo ($_SESSION['delmsg'] = ""); ?>
                                        </div>
                                    <?php } ?>

                                    <form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">

                                        <?php

                                        $query = mysqli_query($con, "select products.*,category.categoryName as catname,category.id as cid,subcategory.subcategory as subcatname,subcategory.id as subcatid from products join category on category.id=products.category join subcategory on subcategory.id=products.subCategory where products.id='$pid'");
                                        $cnt = 1;
                                        while ($row = mysqli_fetch_array($query)) {



                                        ?>


                                            <div class="control-group">
                                                <label class="control-label" for="basicinput">Category</label>
                                                <div class="controls">
                                                    <select name="category" class="span8 tip" onChange="getSubcat(this.value);" required>
                                                        <option value="<?php echo ($row['cid']); ?>">
                                                            <?php echo ($row['catname']); ?></option>
                                                        <?php $query = mysqli_query($con, "select * from category");
                                                        while ($rw = mysqli_fetch_array($query)) {
                                                            if ($row['catname'] == $rw['categoryName']) {
                                                                continue;
                                                            } else {
                                                        ?>

                                                                <option value="<?php echo $rw['id']; ?>">
                                                                    <?php echo $rw['categoryName']; ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label" for="basicinput">Sub Category</label>
                                                <div class="controls">

                                                    <select name="subcategory" id="subcategory" class="span8 tip" required>
                                                        <option value="<?php echo ($row['subcatid']); ?>">
                                                            <?php echo ($row['subcatname']); ?></option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label" for="basicinput">Product Name</label>
                                                <div class="controls">
                                                    <input type="text" name="productName" placeholder="Enter Product Name" value="<?php echo ($row['productName']); ?>" class="span8 tip">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="basicinput">Product Company</label>
                                                <div class="controls">
                                                    <input type="text" name="productCompany" placeholder="Enter Product Comapny Name" value="<?php echo ($row['productCompany']); ?>" class="span8 tip" required>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="basicinput">Product Price Before
                                                    Discount</label>
                                                <div class="controls">
                                                    <input type="text" name="productpricebd" placeholder="Enter Product Price" value="<?php echo ($row['productPriceBeforeDiscount']); ?>" class="span8 tip" required>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="basicinput">Product Price</label>
                                                <div class="controls">
                                                    <input type="text" name="productprice" placeholder="Enter Product Price" value="<?php echo ($row['productPrice']); ?>" class="span8 tip" required>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="basicinput">Product Description</label>
                                                <div class="controls">
                                                    <textarea name="productDescription" placeholder="Enter Product Description" rows="6" class="span8 tip">
<?php echo ($row['productDescription']); ?>
</textarea>
                                                </div>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label" for="basicinput">Product Availability</label>
                                                <div class="controls">
                                                    <select name="productAvailability" id="productAvailability" class="span8 tip" required>
                                                        <option value="<?php echo ($row['productAvailability']); ?>">
                                                            <?php echo ($row['productAvailability']); ?></option>
                                                        <option value="In Stock">In Stock</option>
                                                        <option value="Out of Stock">Out of Stock</option>
                                                    </select>
                                                </div>
                                            </div>



                                            <div class="control-group">
                                                <label class="control-label" for="basicinput">Product Image1</label>
                                                <div class="controls">
                                                    <img src="<?php echo ($row['productImage1']); ?>" width="200" height="100"> <a href="update-product-image.php?id=<?php echo $row['id']; ?>">Change Image</a>
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