<?php
include_once 'admin/deletebanner.php';

session_start();
if (isset($_POST['product_id'])) {
    $handle = new DBcontroller();
    $p_id = $_POST['product_id'];
    $rating = $_POST['rating'];
    $message = $_POST['message'];
    $query = "select * from registration where email='" . $_SESSION['session_id'] . "'";
    $v = $handle->fetchresult($query);
    $id = $v['registration_id'];
    date_default_timezone_set('Asia/Kolkata');
    $timestamp = date('y/m/d h:i:s A');
    $query1 = "insert into review(`rating`,`message`,`added_on`,`product_id`,`user_id`,`status`) values('$rating','$message',' $timestamp','$p_id','$id','hide')";
    $res = $handle->executequery($query1);
    $query3 = "select review.*,registration.registration_id,first_name,last_name,image,gender, product.product_id,product_name from review,registration,product where review.user_id=registration.registration_id and product.product_id=review.product_id and product.product_id='$p_id' order by review.review_id desc limit 5";
    $result2 = $handle->executequery($query3);
    if ($res && $result2) {
        while ($row = mysqli_fetch_assoc($result2)) { ?>

            <div class="media mt-4">
                <?php if (!empty($row['image'])) { ?>
                    <img src="admin/images/<?php echo $row['image'] ?>" alt="Image" class="img-fluid rounded-circle mr-3 mt-1" style="width: 45px;">
                <?php } elseif ($row['gender'] == 'Male') { ?>
                    <img src="admin/images/male.jpg" alt="Image" class="img-fluid rounded-circle mr-3 mt-1" style="width: 45px;">

                <?php } elseif ($row['gender'] == 'Female') { ?>
                    <img src="admin/images/female.jpg" alt="Image" class="img-fluid rounded-circle mr-3 mt-1" style="width: 45px;">

                <?php } ?>
                <div class="media-body">
                    <h6><?php echo $row['last_name'] . " " . $row['first_name'] ?><small> - <i><?php echo $row['added_on'] ?>
                            </i></small></h6>
                    <div class="text-primary mb-2 " style="color:#fd7e14">
                        <?php if ($row['rating'] == 1) { ?>

                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>

                        <?php } elseif ($row['rating'] == 2) { ?>

                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        <?php } elseif ($row['rating'] == 3) { ?>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>

                        <?php } elseif ($row['rating'] == 4) { ?>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        <?php } else { ?>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        <?php } ?>
                    </div>
                    <h6><?php echo $row['message'] ?></h6>
                </div>
            </div>
<?php }
        echo $row;
    }
}
