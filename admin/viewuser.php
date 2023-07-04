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
<script>
    function pagination(page) {
        $.ajax({
            type: "POST",
            url: "userpagination.php",
            data: {
                page: page
            },
            success: function(data) {
                $('#paginationuser').html(data);
            }
        });
    }
</script>

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
                function confirmdata(id) {
                    var ans = confirm('Are you sure want to delete ?');
                    if (ans == false) {
                        return false;
                    } else {
                        window.location = 'deletecategory.php?category_id=' + id;
                    }
                }
            </script>
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


            $query = "select * from registration order by registration_id desc limit $start_from,$num_per_page";
            $result = $handle->executequery($query);

            ?>

            <div class="main-panel" id="paginationuser">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <a style="text-decoration:none">
                                        <h2 class="card-title my-2" id="hover">View Users</h2>
                                    </a>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-description">
                                    </p>
                                    <div class="table-responsive pt-3">
                                        <table class="table table-bordered">
                                            <thead class="text-white" style="background-color:#4B49AC;">
                                                <tr>
                                                    <th>
                                                        #
                                                    </th>
                                                    <th>
                                                        User name
                                                    </th>
                                                    <th>
                                                        User Image
                                                    </th>
                                                    <th>
                                                        Email
                                                    </th>
                                                    <th>
                                                        Phone No
                                                    </th>
                                                    <th>
                                                        Address
                                                    </th>
                                                    <th>
                                                        City
                                                    </th>
                                                    <th>
                                                        State
                                                    </th>
                                                    <th>
                                                        Country
                                                    </th>
                                                    <th>
                                                        Status
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $sum = 0;
                                                $path = "images/";
                                                while ($array = mysqli_fetch_array($result)) { ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $sum = $sum + 1; ?>

                                                        </td>
                                                        <td><?php echo $array['first_name'] . " " . $array['last_name'] ?></td>

                                                        <td class="p-1">
                                                            <?php if (isset($array['image']) and $array['image'] != '') { ?>
                                                                <center><img class="rounded-circle" style="border-radius:0px; height:60px; width:70px" src="<?php echo $path . $array['image'] ?>"> </center>
                                                                <?php } else {
                                                                if ($array['gender'] == 'Male') { ?>
                                                                    <center><img style=" height:60px; width:70px; border-radius:10px;" src="images/male.jpg"> </center>

                                                                <?php  } else { ?>
                                                                    <center><img style=" height:60px; width:70px; border-radius:10px;" src="images/female.jpg"> </center>

                                                            <?php  }
                                                            }
                                                            ?>


                                                        </td>

                                                        <td>
                                                            <?php echo $array['email'] ?>
                                                        </td>
                                                        <td><?php echo $array['phone_no'] ?></td>
                                                        <td><?php echo $array['address'] ?></td>

                                                        <td><?php echo $array['city'] ?></td>

                                                        <td><?php echo $array['state'] ?></td>

                                                        <td><?php echo $array['country'] ?></td>
                                                        <?php if ($array['status'] == 'Register') { ?>
                                                            <td class="text-warning font-weight-bolder"><?php echo $array['status'] ?></td>
                                                        <?php } elseif ($array['status'] == 'Login') { ?>
                                                            <td class="text-success font-weight-bolder"><?php echo $array['status'] ?></td>

                                                        <?php } elseif ($array['status'] == 'Logout') { ?>
                                                            <td class="text-danger font-weight-bolder"><?php echo $array['status'] ?></td>

                                                        <?php } else { ?>
                                                            <td class="font-weight-bolder"><?php echo $array['status'] ?></td>

                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <center> <?php
                            $total_record = $handle->numrows($query);

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