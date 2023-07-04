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
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_settings-panel.html -->
            <?php include_once 'partial.php' ?>
            <!-- partial -->
            <!-- partial:../../partials/_sidebar.html -->
            <?php include_once 'sidebar.php' ?>
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
                                    <form class="forms-sample" action="check_addproduct.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Category Name</label>
                                            <select name="category_id" class="form-control text-dark" onchange="getsubcategory(this.value)" id="exampleInputName1" placeholder="Category name" required>
                                                <option selected>Select Category</option>
                                                <?php foreach ($result as $array) { ?>
                                                    <option value="<?php echo $array['category_id'] ?>"><?php echo $array['category_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Sucategory Name</label>
                                            <select class="form-control text-dark" id="subcategory_list" name="subcategory_id" placeholder="Category name" required>
                                                <option selected>Select Category</option>


                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Product Name</label>
                                            <input type="text" name="product_name" class="form-control" id="exampleInputName1" placeholder="Enter product name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Product Description</label>
                                            <input type="text" name="product_description" class="form-control" id="exampleInputName1" placeholder="Enter product description" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Image 1</label>
                                            <input type="file" name="image1" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Image 2</label>
                                            <input type="file" name="image2" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Image 3</label>
                                            <input type="file" name="image3" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Convert</label>
                                            <select class="form-control" name="convert">
                                                <option selected value="Y">Yes</option>
                                                <option value="N">No</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Price</label>
                                            <input type="Number" name="price" class="form-control" id="exampleInputName1" placeholder="Enter product description" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Qty</label>
                                            <input type="Number" name="qty" class="form-control" id="exampleInputName1" placeholder="Enter product description" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Product flavours</label>
                                            <input type="text" name="product_flavour" class="form-control" pattern="[a-zA-Z'-'\s]*" title="Only character are allowed" id="exampleInputName1" placeholder="Enter product Flavour" required>
                                        </div>
                                        <button type="submit" name="submitproduct" class="btn btn-primary mr-2">Submit</button>
                                        <a href="viewsubcategory.php" class="btn btn-light">Cancel</a>
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