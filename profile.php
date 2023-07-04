  <!DOCTYPE html>
  <html lang="zxx">

  <head>
      <?php include_once 'head.php' ?>

  </head>
  <style>
      #style4,
      li {
          color: #fd7e14;
      }

      #style4:hover {
          color: black;
      }





      #container1 {
          position: relative;
          width: 100%;
          max-width: 400px;
      }

      #container1 img {
          width: 70%;
          height: auto;
      }

      #container1 .btn {
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          -ms-transform: translate(-50%, -50%);
          background-color: #555;
          color: white;
          font-size: 16px;
          padding: 12px 24px;
          border: none;

          cursor: pointer;
          border-radius: 5px;
          text-align: center;
          background-color: rgba(0, 0, 0, 0.2);


      }

      #container1 .btn:hover {
          background-color: rgba(0, 0, 0, 0.7);

      }
  </style>
  <script>
      $(document).ready(function() {

          var email = $('.email').text();
          //   alert(email);
          $('.change').on('click', function() {
              $.ajax({
                  url: 'changeaddress.php',
                  type: "POST",
                  data: {
                      email_id: email
                  },
                  success: function(data) {
                      //   alert(data);
                      $('.change_detail').html(data);
                  }
              });

          });
      });
  </script>

  <body>
      <!-- Page Preloder -->
      <!-- <div id="preloder">
          <div class="loader"></div>
      </div> -->

      <!-- Offcanvas Menu Begin -->

      <!-- Offcanvas Menu End -->

      <!-- Header Section Begin -->
      <?php include_once 'header.php' ?>
      <!-- Header Section End -->

      <div class="container-fluid py-3">
          <div class="row">
              <div class="col">
                  <nav aria-label="breadcrumb" class="bg-white shadow rounded-3 p-3 mb-4">
                      <ol class="breadcrumb mb-0">
                          <li class="breadcrumb-item"><a href="index.php">Home</a></li>

                          <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                      </ol>
                  </nav>
              </div>
          </div>

          <div class="row">
              <?php include 'profilesidebar.php';

                // include './admin/dbcontroller.php';
                // $handle = new DBcontroller();
                $query = "select * from registration where email='" . $_SESSION['session_id'] . "'";
                $fetch = $handle->fetchresult($query);


                ?>
              <div class="col-lg-9 col-md-9 col-sm-9 change_detail">
                  <div class="section-title">

                      <center>
                          <!-- <h3>Order</h3></br> -->
                          <a> <span>
                                  View User Detail
                              </span></a>
                      </center>
                  </div>
                  <div class="card mb-4">
                      <div class="card-body">
                          <p style="margin-bottom: 20px; color:black">Welcome to your Account Dashboard you have the ability to view your recent account activity and update your account information. Select a link below to view or edit your information.</p><br><br>
                          <div class="row">
                              <div class="col-sm-3">
                                  <p class="mb-0" id="style4">Full Name : </p>
                              </div>
                              <div class="col-sm-9">
                                  <p class="text-muted mb-0"><?php echo $fetch['first_name'] . " " . $fetch['last_name'] ?></p>
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-sm-3">
                                  <p class="mb-0" id="style4">Email : </p>
                              </div>
                              <div class="col-sm-9">
                                  <p class="text-muted mb-0 email"><?php echo $fetch['email'] ?></p>
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-sm-3">
                                  <p class="mb-0" id="style4">Phone : </p>
                              </div>
                              <div class="col-sm-9">
                                  <p class="text-muted mb-0"><?php echo $fetch['phone_no'] ?></p>
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-sm-3">
                                  <p class="mb-0" id="style4">Gender : </p>
                              </div>
                              <div class="col-sm-9">
                                  <p class="text-muted mb-0"><?php echo $fetch['gender'] ?></p>
                              </div>
                          </div>

                          <hr>
                          <div class="row">
                              <div class="col-sm-3">
                                  <p class="mb-0" id="style4">City : </p>
                              </div>
                              <div class="col-sm-9">
                                  <p class="text-muted mb-0"><?php echo $fetch['city'] ?></p>
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-sm-3">
                                  <p class="mb-0" id="style4">State : </p>
                              </div>
                              <div class="col-sm-9">
                                  <p class="text-muted mb-0"><?php echo $fetch['state'] ?></p>
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-sm-3">
                                  <p class="mb-0" id="style4">Country : </p>
                              </div>
                              <div class="col-sm-9">
                                  <p class="text-muted mb-0"><?php echo $fetch['country'] ?></p>
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-sm-3">
                                  <p class="mb-0" id="style4">Address : </p>
                              </div>
                              <div class="col-sm-9">
                                  <p class="text-muted mb-0"><?php echo $fetch['address'] ?></p>
                              </div>
                          </div>

                          <!--  -->
                          <!-- <div class="btn btn-primary mt-3">Change user Detail</div> -->
                          <button class="site-btn mt-3 px-3 change" style="font-size:12px;" name="insertorder">Change Detail</button>
                      </div>
                  </div>


              </div>
          </div>
      </div>


      <!-- Instagram Section Begin -->

      <!-- Instagram Section End -->



      <!-- Footer Section Begin -->
      <?php include_once 'footer.php' ?>
  </body>

  </html>