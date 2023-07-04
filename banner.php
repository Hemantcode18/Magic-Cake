 <?php include_once 'admin/dbcontroller.php';
    $handle = new DBcontroller();
    $query = "select * from banner where banner_type='slider' and status='active' order by banner_index desc";
    $result = $handle->executequery($query);


    ?>
 <style>
     @media (max-width:544px) {
         .imagebanner {
             height: 400px;
         }
     }



     @media (min-width:768px) {}

     @media (min-width:992px) {}
 </style>
 <section class="hero">
     <div class="hero__slider owl-carousel">
         <?php while ($row = mysqli_fetch_array($result)) { ?>
             <div class="hero__item set-bg imagebanner" data-setbg="admin/bannerimages/convert/TH<?php echo $row['banner_image'] ?>">
                 <div class="container">
                     <div class="row d-flex justify-content-center">
                         <div class="col-lg-8">
                             <div class="">
                                 <h2 class="font-weight-bolder text-white"><?php echo $row['banner_caption'] ?></h2>
                                 <center> <a href="#" class="primary-btn">Our cakes</a></center>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         <?php } ?>
     </div>
 </section>