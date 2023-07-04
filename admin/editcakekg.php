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
            <?php
            include_once 'dbcontroller.php';
            $handle = new DBcontroller();
            $kg_id = $handle->secure($_GET['kg_id']);
            $query = "select * from product_kg where kg_id='$kg_id'";
            $res = $handle->fetchresult($query);

            ?>
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
                                    $query2 = "select * from product order by product_id";
                                    $res2 = $handle->executequery($query2);
                                    ?>
                                    <form class="forms-sample" action="check_editcakekg.php" method="post">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Prodct Name</label>
                                            <select name="product_name" class="form-control text-dark" required>

                                                <?php
                                                while ($row = mysqli_fetch_array($res2)) {
                                                    if ($row['product_id'] == $res['product_id']) {
                                                        echo  '<option value=' . $row['product_id'] . ' selected >' . $row['product_name'] . '</option>';
                                                    } elseif ($row['product_id'] != $res['product_id']) {
                                                        echo  '<option value=' . $row['product_id'] . '>' . $row['product_name'] . '</option>';
                                                    }
                                                }

                                                ?>
                                            </select>
                                        </div>
                                        <input type="hidden" name="kg_id" value="<?php echo  $res['kg_id'] ?>">
                                        <div class="form-group">
                                            <label for="exampleInputName1 text-dark">Cake QTY</label>
                                            <input type="text" class="form-control" name="cake_qty" id="exampleInputName1" value="<?php echo $res['cake_qty'] ?>" placeholder="Enetr the cake qty" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1 text-dark">Cake KG</label>
                                            <input type="text" class="form-control" name="cake_kg" value="<?php echo $res['cake_kg'] ?>" id="exampleInputName1" placeholder="Eneter the cake kg" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1 text-dark">Cake Price</label>
                                            <input type="text" class="form-control" name="cake_price" value="<?php echo $res['cake_price'] ?>" id="exampleInputName1" placeholder="Eneter the cake price" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1 text-dark">Product Rename</label>
                                            <input type="text" class="form-control" name="product_rename" value="<?php echo $res['product_rename'] ?>" id="exampleInputName1" placeholder="Eneter the product rename" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2 " vallue="" name="cakekg">Submit</button>
                                        <a href="viewkg.php" class="btn btn-light">Cancel</a>
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