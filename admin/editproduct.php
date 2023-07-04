<?php
if (isset($_GET['product_id'])) {
    include_once 'dbcontroller.php';
    $handle = new DBcontroller();

    $product_id = $handle->secure($_GET['product_id']);
    $query = "select category.category_id,category_name,subcategory.subcategory_id,subcategory_name,product.* from category,subcategory,product where product.subcategory_id=subcategory.subcategory_id and category.category_id=subcategory.category_id and product.product_id='$product_id' order by product.product_id desc";

    $row = $handle->fetchresult($query);
    $path = "productimages/convertimages/RC";


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include_once 'head.php' ?>
    </head>

    <body>
        <div class="container-scroller">
            <!-- partial:../../partials/_navbar.html -->
            <?php include_once 'nav.php' ?>
            <!-- partial -->
            <script>
                function getsubcategory(value) {
                    $.ajax({
                        type: "post",
                        url: "getsubcategory.php",
                        data: {
                            cat_id: value
                        },
                        success: function(data) {
                            $('#subcategory_list').html(data);
                        }
                    });


                }
            </script>
            <div class="container-fluid page-body-wrapper">
                <!-- partial:../../partials/_settings-panel.html -->
                <?php include_once 'partial.php' ?>
                <!-- partial -->
                <!-- partial:../../partials/_sidebar.html -->
                <?php include_once 'sidebar.php' ?>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row">

                            <div class="col-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">

                                        <p class="card-description">

                                        </p>
                                        <?php
                                        if (isset($_GET['message'])) {
                                            echo  "<div class='alert alert-danger font-weight-bolder '>" .  $_GET['message'] . "</div>";
                                        } else {
                                        }
                                        ?>
                                        <?php
                                        include_once 'dbcontroller.php';
                                        $handle = new dbcontroller;
                                        $query = "select * from category";
                                        $result = $handle->runquery($query);

                                        ?>
                                        <form class="forms-sample" action="check_editproduct.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>" />
                                            <div class="form-group">
                                                <label for="exampleInputName1">Category Name</label>
                                                <select name="category_id" class="form-control text-dark" onchange="getsubcategory(this.value)" id="exampleInputName1" placeholder="Category name" required>
                                                    <option selected>Select Category</option>
                                                    <?php foreach ($result as $array) {
                                                        if ($array['category_id'] == $row['category_id']) { ?>
                                                            <option selected value="<?php echo $array['category_id'] ?>">
                                                                <?php echo $array['category_name'] ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $array['category_id'] ?>">
                                                                <?php echo $array['category_name'] ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Sucategory Name</label>
                                                <select class="form-control text-dark" id="subcategory_list" name="subcategory_id" placeholder="Category name" required>
                                                    <option selected>Select Category</option>
                                                    <?php $query2 = "select * from subcategory";
                                                    $result2 = $handle->runquery($query2);
                                                    foreach ($result2 as $array2) { ?>
                                                        <?php if ($row['subcategory_id'] == $array2['subcategory_id']) { ?>
                                                            <option selected value="<?php echo $array2['subcategory_id'] ?>">
                                                                <?php echo $array2['subcategory_name'] ?></option>

                                                        <?php } elseif ($row['subcategory_id'] != $array2['subcategory_id']) { ?>
                                                            <option value="<?php echo $array2['subcategory_id'] ?>">
                                                                <?php echo $array2['subcategory_name'] ?></option>

                                                    <?php }
                                                    }

                                                    ?>


                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Product Name</label>
                                                <input type="text" name="product_name" value="<?php echo $row['product_name'] ?>" class="form-control" id="exampleInputName1" placeholder="Enter product name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Product Description</label>
                                                <input type="text" name="product_des" class="form-control" value="<?php echo $row['product_des'] ?>" id="exampleInputName1" placeholder="Enter product description" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Image 1</label>
                                                <input type="file" name="image1" class="form-control">
                                                <img class="my-2" src="<?php echo $path . $row['image1'] ?>" height="90px" width="120px">

                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Image 2</label>
                                                <input type="file" name="image2" class="form-control">
                                                <img class="my-2" src="<?php echo $path . $row['image2'] ?>" height="90px" width="120px">

                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Image 3</label>
                                                <input type="file" name="image3" class="form-control">
                                                <img class="my-2" src="<?php echo $path . $row['image3'] ?>" height="90px" width="120px">

                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Convert</label>
                                                <select class="form-control   text-dark" name="convert">
                                                    <?php if ($row['convert'] == 'Y') { ?>
                                                        <option selected value="Y">Yes</option>
                                                        <option value="N">No</option>
                                                    <?php } else { ?>
                                                        <option value="Y">Yes</option>
                                                        <option value="N" selected>No</option>
                                                    <?php } ?>

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Price</label>
                                                <input type="Number" name="price" value="<?php echo $row['price'] ?>" class="form-control" id="exampleInputName1" placeholder="Enter product description" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Qty</label>
                                                <input type="Number" name="qty" value="<?php echo $row['qty'] ?>" class="form-control" id="exampleInputName1" placeholder="Enter product description" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Product flavours</label>
                                                <input type="text" name="product_flavour" value="<?php echo $row['product_flavour'] ?>" class="form-control" pattern="[a-zA-Z'-'\s]*" title="Only character are allowed" id="exampleInputName1" placeholder="Enter product Flavour" required>
                                            </div>
                                            <button type="submit" name="submiteditproduct" class="btn btn-primary mr-2">Submit</button>
                                            <a href="viewproduct.php" class="btn btn-light">Cancel</a>
                                        </form>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:../../partials/_footer.html -->

                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <?php include_once 'footer.php' ?>
    </body>

    </html>
<?php } ?>