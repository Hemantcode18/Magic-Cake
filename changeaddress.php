   <?php
    include './admin/dbcontroller.php';
    $handle = new DBcontroller();
    $query = "select * from registration where email='" . $_POST['email_id'] . "'";
    $fetch = $handle->fetchresult($query);


    ?>
   <script>
       $(document).ready(function() {

           $('.change_data').on('click', function() {

               $.ajax({

                   url: "upduserdata.php",
                   type: "post",
                   data: $('#submit_form').serialize(),
                   success: function(data) {
                       window.location = 'profile.php';

                   }
               });
           });
       });
   </script>

   <div class="section-title">

       <center>
           <!-- <h3>Order</h3></br> -->
           <a> <span>
                   Change User Detail
               </span></a>
       </center>
   </div>
   <div class="card my-4">
       <div class="card-body">
           <form id="submit_form">
               <!-- <p style="margin-bottom: 20px; color:black">Welcome to your Account Dashboard you have the ability to view your recent account activity and update your account information. Select a link below to view or edit your information.</p><br><br> -->
               <div class="row">
                   <div class="col-sm-3">
                       <p class="mb-0" id="style4">First Name : </p>
                   </div>
                   <div class="col-sm-5">
                       <input type="text" class="form-control" name="fname" value="<?php echo $fetch['first_name'] ?>">
                   </div>
               </div>

               <hr>
               <div class="row">
                   <div class="col-sm-3">
                       <p class="mb-0" id="style4">Last Name : </p>
                   </div>
                   <div class="col-sm-5">
                       <input type="text" class="form-control" name="lname" value="<?php echo $fetch['last_name'] ?>">

                   </div>
               </div>
               <hr>
               <div class="row">
                   <div class="col-sm-3">
                       <p class="mb-0" id="style4">Email : </p>
                   </div>
                   <div class="col-sm-5">
                       <input type="text" class="form-control" name="email" value="<?php echo $fetch['email'] ?>" readonly="true">

                   </div>
               </div>
               <hr>
               <div class="row">
                   <div class="col-sm-3">
                       <p class="mb-0" id="style4">Phone : </p>
                   </div>
                   <div class="col-sm-5">
                       <input type="text" class="form-control" name="phone_no" value="<?php echo $fetch['phone_no'] ?>">
                   </div>
               </div>
               <hr>
               <div class="row">
                   <div class="col-sm-3">
                       <p class="mb-0" id="style4">Gender : </p>
                   </div>
                   <div class="col-sm-9">
                       <?php if ($fetch['gender'] == "Male") {
                            echo ' <input type="radio" name="gender" value="Male" checked>&nbsp;Male&nbsp;&nbsp;
                        <input name="gender" value="Female" type="radio">&nbsp;Female&nbsp;&nbsp;
                        <input name="gender" value="Other" type="radio">&nbsp;Other';
                        } elseif ($fetch['gender'] == "Female") {
                            echo ' <input type="radio" name="gender" value="Male" >&nbsp;Male&nbsp;&nbsp;
                        <input name="gender" value="Female" type="radio" checked>&nbsp;Female&nbsp;&nbsp;
                        <input name="gender" value="Other" type="radio">&nbsp;Other';
                        } else {
                            echo ' <input type="radio" name="gender" value="Male" >&nbsp;Male&nbsp;&nbsp;
                        <input name="gender" value="Female" type="radio" >&nbsp;Female&nbsp;&nbsp;
                        <input name="gender" value="Other" type="radio" checked>&nbsp;Other';
                        }

                        ?>


                   </div>
               </div>

               <hr>
               <div class="row">
                   <div class="col-sm-3">
                       <p class="mb-0" id="style4">City : </p>
                   </div>
                   <div class="col-sm-5">
                       <input type="text" name="city" class="form-control" value="<?php echo $fetch['city'] ?>">

                   </div>
               </div>
               <hr>
               <div class="row">
                   <div class="col-sm-3">
                       <p class="mb-0" id="style4">State : </p>
                   </div>
                   <div class="col-sm-5">
                       <input type="text" name="state" class="form-control" value="<?php echo $fetch['state'] ?>">

                   </div>
               </div>
               <hr>
               <div class="row">
                   <div class="col-sm-3">
                       <p class="mb-0" id="style4">Country : </p>
                   </div>
                   <div class="col-sm-5">
                       <input type="text" name="country" class="form-control" value="<?php echo $fetch['country'] ?>">

                   </div>
               </div>
               <hr>
               <div class="row">
                   <div class="col-sm-3">
                       <p class="mb-0" id="style4">Address : </p>
                   </div>
                   <div class="col-sm-5">
                       <textarea type="text" rows="3" name="address" class="form-control"><?php echo $fetch['address'] ?></textarea>

                   </div>
               </div>

               <!--  -->
               <!-- <div class="btn btn-primary mt-3">Change user Detail</div> -->
               <div class="row">
                   <div class="col-sm-3">
                       <button class="site-btn mt-3 px-5 change_data" style="font-size:12px;" name="insertorder">Submit</button>

                   </div>
                   <div class="col-sm-5">
                       <button onclick="window.location='profile.php'" class="site-btn mt-3 px-3  change" style="font-size:12px;" name="insertorder">Back</button>

                   </div>
               </div>
           </form>
       </div>
   </div>