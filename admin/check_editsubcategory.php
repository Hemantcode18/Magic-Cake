<?php
include_once 'dbcontroller.php';

if (isset($_POST['editsubcategory'])) {
    $handle = new DBcontroller();
    $category_id = $handle->secure($_POST['category_id']);

    $subcategory_id = $handle->secure($_POST['subcategory_id']);
    $subcategory_name = $handle->secure($_POST['subcategory_name']);

    $subcategory_des = $handle->secure($_POST['subcategory_des']);
    $convert = trim($_POST['convert']);
    $files = time() . ".jpg";
    $image_O = "T" . $files;
    $image_C = "TH" . $files;
    if ($_FILES['subcategory_image']['name'] != "") {
        if ($_FILES['subcategory_image']['type'] != 'image/png' && $_FILES['subcategory_image']['type'] != 'image/jpg' && $_FILES['subcategory_image']['type'] != 'image/jpeg') {
            header('Location:addcategory.php?message=Please select only png,jpg and jpeg format');
        } else {

            $originalpath = "subcategoryimages/original/";
            $convertedpath = "subcategoryimages/convert/";
            move_uploaded_file($_FILES['subcategory_image']['tmp_name'], $originalpath . $image_O);
            if ($_POST['convert'] == 'Y') {

                include_once 'simpleimage.php';
                $image = new SimpleImage();
                $image->load($originalpath . $image_O);
                $image->resize(1263, 1200);
                $image->save($convertedpath . $image_C);
                $image = imagecreatefromjpeg($convertedpath . $image_C);
                $destination = $convertedpath . $image_C;
            } else {
                copy($originalpath . $image_O, $convertedpath . $image_C);
            }
            $query = "update subcategory set `subcategory_name`='$subcategory_name',`subcategory_image`='$files', `convert`='$convert',`subcategory_des`='$subcategory_des',`category_id`='$category_id',`status`='active' where subcategory_id='$subcategory_id'";
            $result = $handle->executequery($query);
            if ($result) {
                header('Location:viewsubcategory.php?message=success');
            } else {
                header('Location:editsubcategory.php?message=Data is not inserted');
            }
        }
    } else {
        $query = "update subcategory set `subcategory_name`='$subcategory_name', `convert`='$convert',`subcategory_des`='$subcategory_des',`category_id`='$category_id',`status`='active' where subcategory_id='$subcategory_id'";

        $result = $handle->executequery($query);
        if ($result) {
            header('Location:viewsubcategory.php?message=success');
        } else {
            header('Location:editsubcategory.php?message=Data is not inserted');
        }
    }
} else {
    header('Location:viewsubcategory.php?message=Wrong button press');
}
