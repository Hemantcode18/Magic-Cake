<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <?php include_once 'head.php' ?>
</head>
<style>
    #hover:hover {
        color: #4B49AC;
    }
</style>

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
        <?php include_once 'nav.php' ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_settings-panel.html -->
            <?php include_once 'partial.php' ?>
            <script>
                $(document).ready(function() {

                    $(".searchp").on("keyup", function() {
                        var a = $(this).val();



                        $.ajax({

                            type: "POST",
                            url: "searchproduct.php",
                            data: {
                                search: a
                            },
                            success: function(data) {

                                $("#tbody").html(data);

                            }
                        });


                    });

                });

                function confirmdata(id) {
                    var ans = confirm('Are you sure want to delete ?');
                    if (ans == false) {
                        return false;
                    } else {
                        window.location = 'deleteproduct.php?product_id=' + id;
                    }
                }

                function deactive(id, status) {

                    $.ajax({
                        type: 'POST',
                        url: 'updstatusproduct.php',

                        data: {
                            product_id: id,
                            status: status,
                        },
                        success: function(data) {
                            $('#status_' + id).html(data);
                        }
                    });

                }


                function active(id, status) {
                    $.ajax({
                        type: 'POST',
                        url: 'updstatusproduct.php',
                        data: {
                            product_id: id,
                            status: status,
                        },
                        success: function(data) {
                            $('#status_' + id).html(data);

                        }
                    });

                }

                function pagination(page) {
                    var sr_no = $('#sr_no').val();
                    $.ajax({
                        type: "POST",
                        url: "productpagination.php",
                        data: {
                            page: page,
                            srno: sr_no
                        },
                        success: function(data) {
                            $('#pagination4').html(data);
                        }
                    });
                }
            </script>
            <!-- partial -->
            <!-- partial:../../partials/_sidebar.html -->
            <?php include_once 'sidebar.php' ?>
            <?php
            include_once 'dbcontroller.php';
            $handle = new DBcontroller();

            if (isset($_GET['page'])) {

                $page = $_GET['page'];
            } else {


                $page = 1;
            }
            $num_per_page = 5;
            $start_from = ($page - 1) * 05;

            $query = "select category.category_id,category_name,subcategory.subcategory_id,subcategory_name,product.* from category,subcategory,product where product.subcategory_id=subcategory.subcategory_id and category.category_id=subcategory.category_id order by product.product_id desc limit $start_from,$num_per_page";
            $row = $handle->runquery($query);
            $path = "productimages/convertimages/RC";
            ?>
            <!-- partial -->
            <div class="main-panel" id="pagination4">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card ">

                                <div class="card-body">
                                    <a style="text-decoration:none" href="addproduct.php">
                                        <h2 class="card-title my-1" id="hover">Add Product</h2>
                                    </a>


                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">

                                <div class="card-body">
                                    <h4 class="card-title">Product</h4>
                                    <p class="card-description">
                                        <input type="text" style="float:right; border:1px solid black; padding:5px 30px 5px 30px; margin-bottom:20px" placeholder="search here" class="searchp">

                                    </p>
                                    <div class="table-responsive pt-3" id="tbody">
                                        <table class="table table-bordered">
                                            <thead class="text-white" style="background-color:#4B49AC;">
                                                <tr>
                                                    <th>
                                                        #
                                                    </th>
                                                    <th>
                                                        Category name
                                                    </th>
                                                    <th>
                                                        Subcategory name
                                                    </th>
                                                    <th>
                                                        Product name
                                                    </th>
                                                    <th>
                                                        Image 1
                                                    </th>
                                                    <th>
                                                        Image 2
                                                    </th>
                                                    <th>
                                                        Image 3
                                                    </th>
                                                    <th>
                                                        Price
                                                    </th>
                                                    <th>
                                                        Qty
                                                    </th>

                                                    <th>
                                                        Status
                                                    </th>
                                                    <th>
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <?php if (!empty($row)) {
                                            ?>
                                                <tbody>
                                                    <?php
                                                    $sum = 0;

                                                    foreach ($row as $array) {
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $sum = $sum + 1; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $array['category_name']
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $array['subcategory_name'] ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $array['product_name'] ?>
                                                            </td>

                                                            <td class="p-1">
                                                                <center><img style="border-radius:0px; height:60px; width:70px" src="<?php echo $path . $array['image1'] ?>"> </center>
                                                            </td>
                                                            <td class="p-1">
                                                                <center><img style="border-radius:0px; height:60px; width:70px" src="<?php echo $path . $array['image2'] ?>"> </center>
                                                            </td>
                                                            <td class="p-1">
                                                                <center><img style="border-radius:0px; height:60px; width:70px" src="<?php echo $path . $array['image3'] ?>"> </center>
                                                            </td>

                                                            <td>
                                                                <i class="fa fa-inr"> </i> <?php echo $array['price'] ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $array['qty'] ?>
                                                            </td>

                                                            <?php if ($array['status'] == 'deactive') { ?>
                                                                <td id="status_<?php echo $array['product_id'] ?>"> <button class="btn btn-danger" onclick="active(<?php echo $array['product_id'] ?>,'active')">Deactive</button></td>

                                                            <?php } else { ?>
                                                                <td id="status_<?php echo $array['product_id'] ?>"> <button class="btn btn-success" onclick="deactive(<?php echo $array['product_id'] ?>,'deactive')">Active</button></td>

                                                            <?php } ?>

                                                            <td>


                                                                <button onclick="return confirmdata(<?php echo $array['product_id'] ?>)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                                <a href="editproduct.php?product_id=<?php echo $array['product_id'] ?>"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a>


                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                    <input type="hidden" id="sr_no" value="<?php echo $sum ?? 1 ?>">

                                                </tbody>
                                            <?php } ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <center> <?php
                            $query1 = "select category.category_id,category_name,subcategory.subcategory_id,subcategory_name,product.* from category,subcategory,product where product.subcategory_id=subcategory.subcategory_id and category.category_id=subcategory.category_id order by product.product_id ";

                            $total_record = $handle->numrows($query1);

                            $total_page = ceil($total_record / $num_per_page);

                            if ($page > 1) { ?>
                        <a onclick='pagination(<?php echo $page - 1 ?>)' class='btn btn-danger'>Previous</a>
                        <?php  }

                            for ($i = 1; $i <= $total_page; $i++) {
                                if ($i == $page) { ?>

                            <a onclick="pagination(<?php echo $i ?>)" class='btn btn-primary active'><?php echo $i ?></a>
                        <?php } else { ?>

                            <a onclick="pagination(<?php echo $i ?>)" class='btn btn-primary'><?php echo $i ?></a>

                        <?php }
                            }
                            if ($i > $page) {
                                if ($page < $total_page) { ?>
                            <a onclick="pagination(<?php echo $page + 1 ?>)" class='btn btn-danger'>Next</a>
                    <?php }
                            }

                    ?>
                </center>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->

                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <?php include_once 'footer.php' ?>
    <!-- End custom js for this page-->
</body>

</html>