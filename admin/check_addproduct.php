<?php
include_once 'dbcontroller.php';
$handle = new DBcontroller();
$subcategory_id = $handle->secure($_POST['subcategory_id']);
$product_name = $handle->secure($_POST['product_name']);
$product_des = $handle->secure($_POST['product_description']);
$product_price = $handle->secure($_POST['price']);
$product_qty = $handle->secure($_POST['qty']);
$product_flavour = $handle->secure($_POST['product_flavour']);
$q = "select * from product where product_name='$product_name' and subcategory_id='$subcategory_id'";
$count = $handle->numrows($q);
if ($count == 0) {
    if (isset($_POST['submitproduct'])) {
        if ($_FILES['image1']['name'] != "" and $_FILES['image2']['name'] != "" and $_FILES['image3']['name'] != "") {
            if ($_FILES['image1']['type'] != 'image/png' && $_FILES['image1']['type'] != 'image/jpg' && $_FILES['image1']['type'] != 'image/jpeg') {
                header('Location:addproduct.php?message=Please select only png,jpg and jpeg format');
            } elseif ($_FILES['image2']['type'] != 'image/png' && $_FILES['image2']['type'] != 'image/jpg' && $_FILES['image2']['type'] != 'image/jpeg') {
                header('Location:addproduct.php?message=Please select only png,jpg and jpeg format');
            } elseif ($_FILES['image3']['type'] != 'image/png' && $_FILES['image3']['type'] != 'image/jpg' && $_FILES['image3']['type'] != 'image/jpeg') {
                header('Location:addproduct.php?message=Please select only png,jpg and jpeg format');
            } else {

                $convert = trim($_POST['convert']);
                $files1 = rand(111111111, 999999999) . '_' . $_FILES['image1']['name'];
                $files2 = rand(111111111, 999999999) . '_' . $_FILES['image2']['name'];
                $files3 = rand(111111111, 999999999)  . '_' . $_FILES['image3']['name'];
                $image1_O = "R" . $files1;
                $image1_C = "RC" . $files1;
                $image2_O = "R" . $files2;
                $image2_C = "RC" . $files2;
                $image3_O = "R" . $files3;
                $image3_C = "RC" . $files3;

                $originalpath = "productimages/original/";
                $convertedpath = "productimages/convertimages/";
                move_uploaded_file($_FILES['image1']['tmp_name'], $originalpath . $image1_O);
                move_uploaded_file($_FILES['image2']['tmp_name'], $originalpath . $image2_O);
                move_uploaded_file($_FILES['image3']['tmp_name'], $originalpath . $image3_O);

                if ($_POST['convert'] == 'Y') {


                    include_once 'simpleimage.php';
                    $image = new SimpleImage();
                    $image->load($originalpath . $image1_O);
                    $image->resize(700, 750);
                    $image->save($convertedpath . "$image1_C");
                    $image = imagecreatefromjpeg($convertedpath  . "$image1_C");
                    $destination = $convertedpath . "$image1_C";
                    $image = new SimpleImage();
                    $image->load($originalpath . $image2_O);
                    $image->resize(700, 750);
                    $image->save($convertedpath . "$image2_C");
                    $image = imagecreatefromjpeg($convertedpath  . "$image2_C");
                    $destination = $convertedpath . "$image2_C";
                    $image = new SimpleImage();
                    $image->load($originalpath . $image3_O);
                    $image->resize(700, 750);
                    $image->save($convertedpath . "$image3_C");
                    $image = imagecreatefromjpeg($convertedpath  . "$image3_C");
                    $destination = $convertedpath . "$image3_C";
                } else {
                    copy($originalpath . "$image1_O", $convertedpath . "$image1_C");
                    copy($originalpath . "$image2_O", $convertedpath . "$image2_C");
                    copy($originalpath . "$image3_O", $convertedpath . "$image3_C");
                }
                $query = "insert into product(`product_name`,`product_des`,`image1`,`image2`,`image3`,`convert`,`price`,`qty`,`product_flavour`,`status`,`subcategory_id`) values('$product_name','$product_des','$files1','$files2','$files3','$convert','$product_price','$product_qty','$product_flavour','active','$subcategory_id')";
                $result = $handle->executequery($query);
                if ($result) {
                    header('Location:viewproduct.php?message=success');
                } else {
                    header('Location:addproduct.php?message=Data is not inserted');
                }
            }
        } else {
            header('location:addproduct.php?message=Please select image....');
        }
    } else {
        header('Location:viewproduct.php?message=Wrong button press');
    }
} else {
    header('location:addproduct.php?message=Product aleardy exist....');
}
