<?php
include_once 'dbcontroller.php';

if (isset($_POST['editbanner'])) {

    $handle = new DBcontroller();
    $banner_id = $handle->secure($_POST['banner_id']);
    $banner_caption = $handle->secure($_POST['banner_caption']);

    $banner_type = $handle->secure($_POST['banner_type']);


    $banner_index = $handle->secure($_POST['image_index']);

    $convert = trim($_POST['convert']);
    $files = time() . ".jpg";
    $image_O = "T" . $files;
    $image_C = "TH" . $files;
    if ($_FILES['banner_image']['name'] != "") {
        if ($_FILES['banner_image']['type'] != 'image/png' && $_FILES['banner_image']['type'] != 'image/jpg' && $_FILES['banner_image']['type'] != 'image/jpeg') {
            header('Location:addcategory.php?message=Please select only png,jpg and jpeg format');
        } else {

            $originalpath = "bannerimages/original/";
            $convertedpath = "bannerimages/convert/";
            move_uploaded_file($_FILES['banner_image']['tmp_name'], $originalpath . $image_O);
            if ($_POST['convert'] == 'Y') {

                include_once 'simpleimage.php';
                $image = new SimpleImage();
                $image->load($originalpath . $image_O);

                $image->resize(1263, 800);
                $image->save($convertedpath . $image_C);
                $image = imagecreatefromjpeg($convertedpath . $image_C);
                $destination = $convertedpath . $image_C;
            } else {
                copy($originalpath . $image_O, $convertedpath . $image_C);
            }
            $query = "update banner set `banner_caption`='$banner_caption',`banner_image`='$files',`banner_type`='$banner_type',`banner_index`='$banner_index', `convert`='$convert',`status`='active' where banner_id='$banner_id'";
            $result = $handle->executequery($query);
            if ($result) {
                header('Location:viewbanner.php?message=success');
            } else {
                header('Location:editbanner.php?message=Data is not inserted');
            }
        }
    } else {
        $query = "update banner set `banner_caption`='$banner_caption',`banner_type`='$banner_type',`banner_index`='$banner_index', `convert`='$convert',`status`='active' where banner_id='$banner_id'";

        $result = $handle->executequery($query);
        if ($result) {
            header('Location:viewbanner.php?message=success');
        } else {
            header('Location:editbanner.php?message=Data is not inserted');
        }
    }
} else {
    header('Location:viewbanner.php?message=Wrong button press');
}
