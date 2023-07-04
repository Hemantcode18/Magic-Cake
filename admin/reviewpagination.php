<?php
include_once 'dbcontroller.php';
$handle = new DBcontroller();
if (isset($_POST['page'])) {

    $page = $_POST['page'];
} else {


    $page = 1;
}
$sum = $_POST['srno'];
$num_per_page = 5;
$start_from = ($page - 1) * 05;
$query = "select review.*,registration.registration_id,first_name,last_name,city,image,gender,product.product_name,image1 from review,registration,product where review.product_id=product.product_id and review.user_id=registration.registration_id order by review.review_id asc limit $start_from,$num_per_page";

$row = $handle->executequery($query);

$path = "images/";
?>



<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <a style="text-decoration:none" href="addcakekg.php">
                        <h2 class="card-title my-2" id="hover">Add Cake KG</h2>
                    </a>
                </div>
            </div>
        </div>


        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Cake kilogram</h4>
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
                                        User Name
                                    </th>
                                    <th>
                                        Image
                                    </th>

                                    <th>
                                        Message
                                    </th>
                                    <th>
                                        Product Detail
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $sum = $start_from;
                                while ($array = mysqli_fetch_array($row)) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $sum = $sum + 1; ?>

                                        </td>
                                        <td><?php echo $array['first_name'] . "  " . $array['last_name'] ?></td>
                                        <td class="p-1">
                                            <?php if (isset($array['image']) and $array['image'] != '') { ?>
                                                <center><img class="rounded-circle" style="border-radius:0px; height:60px; width:70px" src="images/<?php echo $array['image'] ?>"> </center>
                                                <?php } else {
                                                if ($array['gender'] == 'Male') { ?>
                                                    <center><img style=" height:60px; width:70px; border-radius:10px;" src="images/male.jpg"> </center>

                                                <?php  } else { ?>
                                                    <center><img style=" height:60px; width:70px; border-radius:10px;" src="images/female.jpg"> </center>

                                            <?php  }
                                            }
                                            ?>


                                        </td>
                                        <td><?php echo $array['message'] ?></td>
                                        <td align="center"><img src="productimages/convertimages/RC<?php echo $array['image1'] ?>" height="50px" width="50px"><br>
                                            <p style="margin-top:10px"><?php echo $array['product_name'] ?></p>
                                        </td>
                                        <?php if ($array['status'] == 'hide') { ?>
                                            <td id="status_<?php echo $array['review_id'] ?>"> <button class="btn btn-danger" onclick="active(<?php echo $array['review_id'] ?>,'active')">Hide</button></td>

                                        <?php } else { ?>
                                            <td id="status_<?php echo $array['review_id'] ?>"> <button class="btn btn-success" onclick="deactive(<?php echo $array['review_id'] ?>,'deactive')">Show</button></td>

                                        <?php } ?>
                                        <td>
                                            <button onclick="return confirmdata(<?php echo $array['review_id'] ?>)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <input type="hidden" id="sr_no" value="<?php echo $sum ?? 1 ?>">
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<center> <?php
            $query1 = "select * from review order by review_id ";

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