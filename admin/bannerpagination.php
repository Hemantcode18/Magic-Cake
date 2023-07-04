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


    $query = "select * from banner order by banner_id asc limit $start_from,$num_per_page";
    $result = $handle->executequery($query);

    ?>


 <div class="content-wrapper">
     <div class="row">
         <div class="col-lg-12 grid-margin stretch-card">
             <div class="card">
                 <div class="card-body">
                     <a style="text-decoration:none" href="addbanner.php">
                         <h2 class="card-title my-2" id="hover">Add Banner</h2>
                     </a>
                 </div>
             </div>
         </div>


         <div class="col-lg-12 grid-margin stretch-card">
             <div class="card">
                 <div class="card-body">
                     <h4 class="card-title">Banner</h4>
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
                                         Banner Caption
                                     </th>
                                     <th>
                                         Banner Image
                                     </th>
                                     <th>
                                         Banner Type </th>
                                     <th>
                                         Banner Index </th>
                                     <th>
                                         Convert
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
                                    $path = "bannerimages/convert/TH";
                                    while ($array = mysqli_fetch_array($result)) { ?>
                                     <tr>
                                         <td>
                                             <?php echo $sum = $sum + 1; ?>

                                         </td>
                                         <td><?php echo $array['banner_caption'] ?></td>

                                         <td class="p-1">
                                             <center><img style="border-radius:0px; height:60px; width:70px" src="<?php echo $path . $array['banner_image'] ?>"> </center>
                                         </td>
                                         <td><?php echo $array['banner_type'] ?></td>
                                         <td><?php echo $array['banner_index'] ?></td>
                                         <td><?php echo $array['convert'] ?></td>

                                         <?php if ($array['status'] == 'deactive') { ?>
                                             <td id="status_<?php echo $array['banner_id'] ?>"> <button class="btn btn-danger" onclick="active(<?php echo $array['banner_id'] ?>,'active')">Deactive</button></td>

                                         <?php } else { ?>
                                             <td id="status_<?php echo $array['banner_id'] ?>"> <button class="btn btn-success" onclick="deactive(<?php echo $array['banner_id'] ?>,'deactive')">Active</button></td>

                                         <?php } ?>
                                         <td>
                                             <button onclick="return confirmdata(<?php echo $array['banner_id'] ?>)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                             <a href="editbanner.php?banner_id=<?php echo $array['banner_id'] ?>"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a>
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
            $query1 = "select * from banner order by banner_id ";
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