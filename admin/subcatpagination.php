 <?php
    include_once 'dbcontroller.php';
    if (isset($_POST['page'])) {

        $page = $_POST['page'];
    } else {


        $page = 1;
    }
    $num_per_page = 5;
    $start_from = ($page - 1) * 05;

    $query = "select c.category_id,category_name,s.* from category c INNER JOIN subcategory s ON c.category_id=s.category_id order by s.subcategory_id desc limit $start_from,$num_per_page ";
    $handle = new DBcontroller();
    $result = $handle->executequery($query);

    ?>
 <div class="content-wrapper">
     <div class="row">
         <div class="col-lg-12 grid-margin stretch-card">
             <div class="card">
                 <div class="card-body">
                     <a style="text-decoration:none" href="addsubcategory.php">
                         <h2 class="card-title my-2" id="hover">Add Subcategory</h2>
                     </a>
                 </div>
             </div>
         </div>


         <div class="col-lg-12 grid-margin stretch-card">
             <div class="card">
                 <div class="card-body">
                     <h4 class="card-title">Subcategories</h4>
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
                                         Category name
                                     </th>
                                     <th>
                                         Subcategory name
                                     </th>
                                     <th>
                                         Image
                                     </th>

                                     <th>
                                         Subcategory description
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
                                    $path = "subcategoryimages/convert/TH";
                                    while ($array = mysqli_fetch_array($result)) { ?>
                                     <tr>
                                         <td>
                                             <?php echo $sum = $sum + 1; ?>
                                         </td>
                                         <td><?php echo $array['category_name'] ?></td>
                                         <td><?php echo $array['subcategory_name'] ?></td>

                                         <td class="p-1">
                                             <center><img style="border-radius:0px; height:60px; width:70px" src="<?php echo $path . $array['subcategory_image'] ?>"> </center>
                                         </td>


                                         <td><?php echo $array['subcategory_des'] ?></td>
                                         <?php if ($array['status'] == 'deactive') { ?>
                                             <td id="status_<?php echo $array['subcategory_id'] ?>"> <button class="btn btn-danger" onclick="active(<?php echo $array['subcategory_id'] ?>,'active')">Deactive</button></td>

                                         <?php } else { ?>
                                             <td id="status_<?php echo $array['subcategory_id'] ?>"> <button class="btn btn-success" onclick="deactive(<?php echo $array['subcategory_id'] ?>,'deactive')">Active</button></td>

                                         <?php } ?>
                                         <td>
                                             <button onclick="return confirmdata(<?php echo $array['subcategory_id'] ?>)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                             <a href="editsubcatyegory.php?subcat_id=<?php echo $array['subcategory_id'] ?>"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a>
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
            $query1 = "select c.category_id,category_name,s.* from category c INNER JOIN subcategory s ON c.category_id=s.category_id order by s.subcategory_id ";

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