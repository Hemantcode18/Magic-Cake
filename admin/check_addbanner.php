<?php
include_once 'dbcontroller.php';

if (isset($_POST['submitbanner'])) {
    $handle = new DBcontroller();
    $banner_caption = $handle->secure($_POST['banner_caption']);
    $banner_type = $handle->secure($_POST['banner_type']);
    $image_index = $handle->secure($_POST['image_index']);


    if (isset($_POST['image_index']) and isset($_POST['banner_type'])) {
        $q = "select * from banner where banner_type='$banner_type' and banner_index='$image_index'";
        $count = $handle->numrows($q);
    } else {
        $count = 0;
    }


    if ($count > 0) {
        header('Location:addbanner.php?message=Banner already exist');
    } else {
        if ($_FILES['banner_image']['name'] != "") {
            if ($_FILES['banner_image']['type'] != 'image/png' && $_FILES['banner_image']['type'] != 'image/jpg' && $_FILES['banner_image']['type'] != 'image/jpeg') {
                header('Location:addbanner.php?message=Please select only png,jpg and jpeg format');
            } else {


                $convert = trim($_POST['convert']);
                $files = time() . ".jpg";
                $image_O = "T" . $files;
                $image_C = "TH" . $files;
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
                $query = "insert into banner(`banner_caption`,`banner_image`,`banner_type`,`banner_index`,`convert`,`status`) values('$banner_caption','$files','$banner_type','$image_index','$convert','active')";
                $result = $handle->executequery($query);
                if ($result) {
                    header('Location:viewbanner.php?message=success');
                } else {
                    header('Location:addbanner.php?message=Data is not inserted');
                }
            }
        } else {
            header('location:addbanner.php?message=Please select image....');
        }
    }
} else {
    header('Location:viewbanner.php?message=Wrong button press');
}
