<?php
include_once 'dbcontroller.php';

if (isset($_POST['editcategory'])) {
    $handle = new DBcontroller();
    $category_id = $handle->secure($_POST['category_id']);
    $category_name = $handle->secure($_POST['category_name']);

    $category_des = $handle->secure($_POST['category_des']);
    $convert = trim($_POST['convert']);
    $files = time() . ".jpg";
    $image_O = "T" . $files;
    $image_C = "TH" . $files;
    if($_FILES['category_image']['name'] != "") {
        if ($_FILES['category_image']['type'] != 'image/png' && $_FILES['category_image']['type'] != 'image/jpg' && $_FILES['category_image']['type'] != 'image/jpeg') {
            header('Location:addcategory.php?message=Please select only png,jpg and jpeg format');
        } else {

            $originalpath = "images/original/";
            $convertedpath = "images/convert/";
            move_uploaded_file($_FILES['category_image']['tmp_name'], $originalpath . $image_O);
            if ($_POST['convert'] == 'Y') {

                include_once 'simpleimage.php';
                $image = new SimpleImage();
                $image->load($originalpath . $image_O);
                $image->resize(330, 420);
                $image->save($convertedpath . $image_C);
                $image = imagecreatefromjpeg($convertedpath . $image_C);
                $destination = $convertedpath . $image_C;
            } else {
                copy($originalpath . $image_O, $convertedpath . $image_C);
            }
            $query = "update category set `category_name`='$category_name',`category_image`='$files', `convert`='$convert',`category_des`='$category_des',`status`='active' where category_id='$category_id'";
            $result = $handle->executequery($query);
            if ($result) {
                header('Location:viewcategory.php?message=success');
            } else {
                header('Location:editcategory.php?message=Data is not inserted');
            }
        }
    } else {
        $query = "update category set `category_name`='$category_name', `convert`='$convert' , `category_des`='$category_des' ,`status`='active' where `category_id`='$category_id'";
        $result = $handle->executequery($query);
        if ($result) {
            header('Location:viewcategory.php?message=success');
        } else {
            header('Location:editcategory.php?message=Data is not inserted');
        }
    }
} else {
    header('Location:viewcategory.php?message=Wrong button press');
}
