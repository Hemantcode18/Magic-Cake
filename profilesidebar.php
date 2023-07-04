<div class="col-lg-3 mx-auto my-2">
    <div class="card mb-3">
        <div class="card-body text-center">
            <?php

            $query = "select * from registration where email='" . $_SESSION['session_id'] . "'";
            $res = $handle->fetchresult($query);


            ?>
            <script type="text/javascript">
                function preview_image(event) {
                    var reader = new FileReader();
                    reader.onload = function() {
                        var output = document.getElementById('output_image');
                        var output2 = document.getElementById('output_image2');
                        output.src = reader.result;
                        output2.src = reader.result;

                    }

                    reader.readAsDataURL(event.target.files[0]);

                }
            </script>
            <div id="container1">

                <!-- <a href="signin.php"><button class="btn ">Signin Now</button></a> -->
                <form id="form" action="ajaxupload.php" method="post" enctype="multipart/form-data">
                    <?php if ($res['image'] == '') { ?>
                        <img id="output_image2" src=" admin/images/mobile-login-concept-illustration_114360-83.jpg" class="rounded-circle mb-3">
                    <?php } else { ?>
                        <img id="output_image" src=" ./admin/images/<?php echo $res['image'] ?>" class="rounded-circle mb-3">


                    <?php } ?>
                    <label type="submit" for="fileimg" class="btn btn-primary px-1 "><i class="fa fa-upload "></i><br>upload</label>
                    <input name="image" onchange="preview_image(event)" type="file" id="fileimg" hidden>
                    <br>
                    <button class="site-btn p-2" type="submit"><i class="fa fa-spinner fa-spin"></i> update</button>
                </form>

            </div>
            <h5 class="my-3"><?php echo $res['last_name'] . " " . $res['first_name'] ?></h5>

            <p class="text-muted mb-4"><?php echo $res['email'] ?> </p>

        </div>
    </div>
    <div class="card mb-3 mb-lg-0">
        <div class="card-body p-0">
            <ul class="list-group list-group-flush rounded-3">
                <li class="list-group-item d-flex left-content-between align-items-center p-3">
                    <i class="fa fa-user fa-lg"></i>&nbsp;&nbsp;&nbsp;
                    <?php if ($_SERVER['PHP_SELF'] == "/magic_cake/profile.php") {
                        echo '<p class="mb-0"><a href="profile.php" class="font-weight-bolder" id="style4">User Detail</a></p>';
                    } else {
                        echo ' <p class="mb-0"><a href="profile.php"  id="style4">User Detail</a></p>';
                    } ?>
                </li>
                <li class="list-group-item d-flex left-content-between align-items-center p-3">
                    <i class="fa fa-shopping-cart fa-lg"></i>&nbsp;&nbsp;&nbsp;
                    <p class="mb-0"><a href="shopping-cart.php" id="style4">View Cart</a></p>
                </li>
                <li class="list-group-item d-flex left-content-between align-items-center p-3">
                    <i class="fa fa-truck fa-lg"></i>&nbsp;&nbsp;&nbsp;
                    <?php if ($_SERVER['PHP_SELF'] == "/magic_cake/vieworder.php") {
                        echo '<p class="mb-0"><a href="vieworder.php" class="font-weight-bolder" id="style4">View order</a></p>';
                    } else {
                        echo ' <p class="mb-0"><a href="vieworder.php"  id="style4">View order</a></p>';
                    } ?>
                </li>
                <li class="list-group-item d-flex left-content-between align-items-center p-3">
                    <i class="fa fa-lock fa-lg"></i>&nbsp;&nbsp;&nbsp;
                    <p class="mb-0"><a href="forgetpassword.php" id="style4">Forget Password</a></p>
                </li>
                <li class="list-group-item d-flex left-content-between align-items-center p-3">
                    <i class="fa fa-key fa-lg"></i>&nbsp;&nbsp;&nbsp;
                    <p class="mb-0"><a href="changepass.php" id="style4">Change Password</a></p>
                </li>
                <li class="list-group-item d-flex left-content-between align-items-center p-3">
                    <i class="fa fa-sign-out fa-lg"></i>&nbsp;&nbsp;&nbsp;
                    <p class="mb-0"><a href="logout.php" id="style4">Signout</a></p>
                </li>


            </ul>
        </div>
    </div>
</div>