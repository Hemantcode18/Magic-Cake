 <?php
    include_once 'dbcontroller.php';
    $handle = new DBcontroller();
    if (isset($_POST['page'])) {

        $page = $_POST['page'];
    } else {


        $page = 1;
    }
    $num_per_page = 5;
    $start_from = ($page - 1) * 05;


    $query = "select * from contact order by contact_id desc limit $start_from,$num_per_page";
    $result = $handle->executequery($query);

    ?>

 <div class="content-wrapper">
     <div class="row">
         <div class="col-lg-12 grid-margin stretch-card">
             <div class="card">
                 <div class="card-body">
                     <a style="text-decoration:none">
                         <h2 class="card-title my-2" id="hover">View Cantact</h2>
                     </a>
                 </div>
             </div>
         </div>


         <div class="col-lg-12 grid-margin stretch-card">
             <div class="card">
                 <div class="card-body">
                     <h4 class="card-title">Categories</h4>
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
                                         Contact Name
                                     </th>
                                     <th>
                                         Email
                                     </th>
                                     <th>
                                         Message
                                     </th>
                                     <th>
                                         Date
                                     </th>
                                     <th>
                                         Action
                                     </th>

                                 </tr>
                             </thead>
                             <tbody>

                                 <?php
                                    $sum = 0;
                                    while ($array = mysqli_fetch_array($result)) { ?>
                                     <tr>
                                         <td>
                                             <?php echo $sum = $sum + 1; ?>

                                         </td>
                                         <td><?php echo $array['name'] ?></td>
                                         <td><?php echo $array['email'] ?></td>
                                         <td><?php echo $array['message'] ?></td>
                                         <td><?php echo $array['date'] ?></td>
                                         <td>
                                             <button onclick="return confirmdata(<?php echo $array['contact_id'] ?>)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                         </td>
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
            if ($i > $page) { ?>
         <a onclick="pagination(<?php echo $page + 1 ?>)" class='btn btn-danger'>Next</a>
     <?php }

        ?>
 </center>
 <!-- content-wrapper ends -->
 <!-- partial:../../partials/_footer.html -->

 <!-- partial -->