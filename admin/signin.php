<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'head.php ' ?>
</head>




<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-5 mx-auto">
                        <div class="auth-form-light text-left py-1  px-4 px-sm-5">
                            <div class="brand-logo mb-0">
                                <img src="images/Cake_Magic-removebg-preview-removebg-preview.png" height="170" alt="logo">
                            </div>
                            <?php
                            if (isset($_GET['success'])) {
                                echo  "<div class='alert alert-success'>" .  $_GET['success'] . "</div>";
                            } elseif (isset($_GET['error'])) {
                                echo  "<div class='alert alert-danger'>" .  $_GET['error'] . "</div>";
                            } else {
                                echo '<h4>Hello! let s get started</h4>';
                            }
                            ?>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form class="pt-3" action="check_signin.php" method="post">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" name="email" id="exampleInputEmail1" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="password" minlength="8" maxlength="8" id="exampleInputPassword1" placeholder="Password" required>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="signin">SIGN IN</button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input">
                                            Keep me signed in
                                        </label>
                                    </div>
                                    <a href="#" class="auth-link text-black">Forgot password?</a>
                                </div>
                                <div class="mb-2">

                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Don't have an account? <a href="register.html" class="text-primary">Create</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../js/off-canvas.js"></script>
    <script src="../../js/hoverable-collapse.js"></script>
    <script src="../../js/template.js"></script>
    <script src="../../js/settings.js"></script>
    <script src="../../js/todolist.js"></script>
    <!-- endinject -->
</body>

</html>