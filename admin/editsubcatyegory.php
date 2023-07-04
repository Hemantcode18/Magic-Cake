<?php
if (isset($_GET['subcat_id'])) {
    include_once 'dbcontroller.php';
    $handle = new DBcontroller();
    $subcategory_id = $handle->secure($_GET['subcat_id']);
    $query = "select c.category_id,category_name,s.* from category c INNER JOIN subcategory s ON c.category_id=s.category_id and s.subcategory_id='$subcategory_id' order by s.subcategory_id desc ";
    $row = $handle->fetchresult($query);


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
                                        $path = "subcategoryimages/convert/TH";
                                        ?>
                                        <form class="forms-sample" action="check_editsubcategory.php" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="hidden" name="subcategory_id" value="<?php echo $row['subcategory_id'] ?>" />
                                                <label for="exampleInputName1">Category Name</label>
                                                <select name="category_id" class="form-control text-dark" id="exampleInputName1" placeholder="Category name" required>

                                                    <!-- <option selected>Select Category</option> -->
                                                    <?php foreach ($result as $array) {
                                                        if ($array['category_id'] == $row['category_id']) { ?>
                                                            <option selected value="<?php echo $array['category_id'] ?>"><?php echo $array['category_name'] ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $array['category_id'] ?>"><?php echo $array['category_name'] ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Subcategory Name</label>
                                                <input type="text" value="<?php echo $row['subcategory_name'] ?>" class="form-control" pattern="[a-zA-Z'-'\s]*" title="Only character are allowed" id="exampleInputName1" name="subcategory_name" placeholder="Subcategory name" required>


                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Subcategory Image</label>
                                                <input type="file" name="subcategory_image" class="form-control">
                                                <?php if (isset($row['subcategory_image'])) { ?>
                                                    <img class="my-2" src="<?php echo $path . $row['subcategory_image'] ?>" height="90px" width="120px">
                                                <?php } ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Convert</label>
                                                <select class="form-control text-dark" name="convert">
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
                                                <label for="exampleInputName1">Subcategory Description</label>
                                                <input name="subcategory_des" type="text" value="<?php echo $row['subcategory_des'] ?>" class="form-control" pattern="[a-zA-Z'-'\s]*" title="Only character are allowed" id="exampleInputName1" placeholder="Subcategory description" required>
                                            </div>

                                            <button type="submit" name="editsubcategory" class="btn btn-primary mr-2">Submit</button>
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
<?php } ?>