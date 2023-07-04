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
                                    <form class="forms-sample" action="check_addbanner.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Banner Caption</label>
                                            <input type="text" name="banner_caption" class="form-control" id="exampleInputName1" placeholder="Enter banner caption" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Banner Image</label>
                                            <input type="file" name="banner_image" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Banner Type</label>
                                            <select class="form-control text-dark " onchange="gettextbox(this.value)" name="banner_type" required>

                                                <option selected>Select Banner Type</option>
                                                <option>Slider</option>
                                                <option>Sweet Maker</option>
                                                <option>Sweet Moment</option>
                                            </select>
                                        </div>
                                        <div class="form-group text-dark">
                                            <label for="exampleInputName1">Image Index</label>
                                            <input type="text" name="image_index" class="form-control text-dark" placeholder="Enter image index" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputName1">Convert</label>
                                            <select class="form-control text-dark" name="convert">
                                                <option selected value="Y">Yes</option>
                                                <option value="N">No</option>

                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary mr-2" name="submitbanner">Submit</button>
                                        <a href="viewcategory.php" class="btn btn-light">Cancel</a>
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