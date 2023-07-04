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
                                    include_once 'dbcontroller.php';
                                    $handle = new DBcontroller();
                                    $query = "select * from product order by product_id";
                                    $res = $handle->executequery($query);
                                    $count = $handle->numrows($query);
                                    ?>
                                    <form class="forms-sample" action="check_addcakekg.php" method="post">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Prodct Name</label>
                                            <select name="product_name" class="form-control" required>
                                                <?php if ($count <= 0) {
                                                    echo '<option selected>No product available</option>';
                                                }
                                                ?>
                                                <option selected>selected product</option>
                                                <?php
                                                while ($row = mysqli_fetch_array($res)) {
                                                    echo  '<option value=' . $row['product_id'] . '>' . $row['product_name'] . '</option>';
                                                }

                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Cake QTY</label>
                                            <input type="text" class="form-control" name="cake_qty" placeholder="Eneter the cake qty" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Cake kg</label>
                                            <input type="text" class="form-control" name="cake_kg" placeholder="Eneter the cake kg" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Cake Price</label>
                                            <input type="text" class="form-control" name="cake_price" placeholder="Eneter the cake price" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Rename product</label>
                                            <input type="text" class="form-control" name="productre_name" placeholder="Eneter the product name" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2" name="cakekg">Submit</button>
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