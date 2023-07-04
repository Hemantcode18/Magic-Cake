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
                    echo '<h4>Hello! let s get started</h4>';
                  }
                  ?>
                  <form class="forms-sample" action="check_addcategory.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputName1">Category Name</label>
                      <input type="text" name="category_name" class="form-control" pattern="[a-zA-Z'-'\s]*" title="Only character are allowed" id="exampleInputName1" placeholder="Category name" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Category Image</label>
                      <input type="file" name="category_image" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Convert</label>
                      <select class="form-control" name="convert">
                        <option selected value="Y">Yes</option>
                        <option value="N">No</option>

                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Category description</label>
                      <input type="text" class="form-control" name="category_des" pattern="[a-zA-Z'-'\s]*" title="Only character are allowed" id="exampleInputName1" placeholder="Category description" required>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="submitcategory">Submit</button>
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