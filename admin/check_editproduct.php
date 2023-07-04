    <?php
    include_once 'dbcontroller.php';
    if (isset($_POST['submiteditproduct'])) {
        $handle = new DBcontroller();
        $product_id = $handle->secure($_POST['product_id']);
        $category_id = $handle->secure($_POST['category_id']);
        $subcategory_id = $handle->secure($_POST['subcategory_id']);

        $product_name = $handle->secure($_POST['product_name']);
        $product_des = $handle->secure($_POST['product_des']);
        $convert = trim($_POST['convert']);
        $product_price = $handle->secure($_POST['price']);
        $product_qty = $handle->secure($_POST['qty']);
        $product_flavour = $handle->secure($_POST['product_flavour']);

        if ($_FILES['image1']['name'] != '') {
            if ($_FILES['image1']['type'] != 'image/png' && $_FILES['image1']['type'] != 'image/jpg' && $_FILES['image1']['type'] != 'image/jpeg') {
                header('Location:editproduct.php?message=Please select only png,jpg and jpeg format in image1&product_id=' . $product_id);
            } else {
                $files1 = rand(111111111, 999999999) . '_' . $_FILES['image1']['name'];
                $image1_O = "R" . $files1;
                $image1_C = "RC" . $files1;
                $originalpath = "productimages/original/";
                $convertpath = "productimages/convertimages/";
                move_uploaded_file($_FILES['image1']['tmp_name'], $originalpath . $image1_O);
                if ($_POST['convert'] == "Y") {
                    // echo "string";
                    // die();
                    include_once 'simpleimage.php';
                    $image = new SimpleImage();
                    $image->load($originalpath . $image1_O);
                    $image->resize(700, 750);
                    $image->save($convertpath . "$image1_C");
                    $image = imagecreatefromjpeg($convertpath  . "$image1_C");
                    //	$destination = $convertpath . "$image_C";
                } else {
                    copy($originalpath . $image1_O, $convertpath . "$image1_C");
                }
                $query = "update product set `product_name`='$product_name',`product_des`='$product_des',`image1`='$files1',`convert`='$convert',`price`='$product_price',`qty`='$product_qty',`product_flavour`='$product_flavour',`status`='active',`subcategory_id`='$subcategory_id' where `product_id`='$product_id'";
            }
        } elseif ($_FILES['image2']['name'] != '') {

            if ($_FILES['image2']['type'] != 'image/png' && $_FILES['image2']['type'] != 'image/jpg' && $_FILES['image2']['type'] != 'image/jpeg') {
                header('Location:editproduct.php?message=Please select only png,jpg and jpeg format in image2 &product_id=' . $product_id);
            } else {
                $files2 = rand(111111111, 999999999) . '_' . $_FILES['image2']['name'];
                $image2_O = "R" . $files2;
                $image2_C = "RC" . $files2;
                $originalpath = "productimages/original/";
                $convertpath = "productimages/convertimages/";
                move_uploaded_file($_FILES['image2']['tmp_name'], $originalpath . $image2_O);
                if ($_POST['convert'] == "Y") {
                    // echo "string";
                    // die();
                    include_once 'SimpleImage.php';
                    $image = new SimpleImage();
                    $image->load($originalpath . $image2_O);
                    $image->resize(700, 750);
                    $image->save($convertpath . "$image2_C");
                    $image = imagecreatefromjpeg($convertpath  . "$image2_C");
                    //	$destination = $convertpath . "$image_C";
                } else {
                    copy($originalpath . $image2_O, $convertpath . "$image2_C");
                }

                $query = "update product set `product_name`='$product_name',`product_des`='$product_des',`image2`='$files2',`convert`='$convert',`price`='$product_price',`qty`='$product_qty',`product_flavour`='$product_flavour',`status`='active',`subcategory_id`='$subcategory_id' where `product_id`='$product_id'";
            }
        } elseif ($_FILES['image3']['name'] != '') {

            if ($_FILES['image3']['type'] != 'image/png' && $_FILES['image3']['type'] != 'image/jpg' && $_FILES['image3']['type'] != 'image/jpeg') {
                header('Location:editproduct.php?message=Please select only png,jpg and jpeg format in image3&product_id=' . $product_id);
            } else {
                $files3 = rand(111111111, 999999999) . '_' . $_FILES['image3']['name'];
                $image3_O = "R" . $files3;
                $image3_C = "RC" . $files3;
                $originalpath = "productimages/original/";
                $convertpath = "productimages/convertimages/";
                move_uploaded_file($_FILES['image3']['tmp_name'], $originalpath . $image3_O);
                if ($_POST['convert'] == "Y") {
                    // echo "string";
                    // die();
                    include_once 'SimpleImage.php';
                    $image = new SimpleImage();
                    $image->load($originalpath . $image3_O);
                    $image->resize(700, 750);
                    $image->save($convertpath . "$image3_C");
                    $image = imagecreatefromjpeg($convertpath  . "$image3_C");
                    //	$destination = $convertpath . "$image_C";
                } else {
                    copy($originalpath . $image3_O, $convertpath . "$image3_C");
                }

                $query = "update product set `product_name`='$product_name',`product_des`='$product_des',`image3`='$files3',`convert`='$convert',`price`='$product_price',`qty`='$product_qty',`product_flavour`='$product_flavour',`status`='active',`subcategory_id`='$subcategory_id' where `product_id`='$product_id'";
            }
        } else {
            $query = "update product set `product_name`='$product_name',`product_des`='$product_des',`convert`='$convert',`price`='$product_price',`qty`='$product_qty',`product_flavour`='$product_flavour',`status`='active',`subcategory_id`='$subcategory_id' where `product_id`='$product_id'";
        }
        $result = $handle->executequery($query);
        if ($result) {
            header('Location:viewproduct.php?message=success');
        } else {
            header('Location:viewproduct.php?message=data is not update');
        }
    } else {
        header('Location:viewproduct.php?message=Wrong button press');
    }
