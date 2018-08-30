<?php

require '../connect/connectdb.php';
require 'treefunction.php';

if($_POST) {
    //รับค่าตัวแปรจากฟอร์ม
    $treeowner_name = $_POST['treeowner_name'];
    $treeowner_age = $_POST['treeowner_age'];
    $treeowner_education = $_POST['treeowner_education'];
    $treeowner_career = $_POST['treeowner_career'];
    $treeowner_revenue = $_POST['treeowner_revenue'];
    $treeowner_health = $_POST['treeowner_health'];
    $treeowner_lat = $_POST['treeowner_lat'];
    $treeowner_lng = $_POST['treeowner_lng'];

    //upload image
    /*$imgName = $_FILES['owner_image']['name'];
    $imgTmp = $_FILES['owner_image']['tmp_name'];
    $path = '../images/owner/';
    $owner_image = insertImage($imgName, $path, $imgTmp);*/
    $ext = pathinfo(($_FILES['treeowner_image']['name']), PATHINFO_EXTENSION); //นามสกุลของไฟล์
    $new_image_name = 'img_' . uniqid() . "." . $ext;
    $image_path = '../images/owner/';
    $upload_path = $image_path . $new_image_name;
    
    //uploading
    $sucess = move_uploaded_file($_FILES['treeowner_image']['tmp_name'], $upload_path);
    
    if ($sucess == TRUE) {
            $size = getimagesize($upload_path);
            $width = 500; 
            $height = 400;
            $images_orig = imagecreatefromjpeg($upload_path); //resize รูปประเภท JPEG 
            $photoX = imagesx($images_orig);
            $photoY = imagesy($images_orig); 
            $images_fin = imagecreatetruecolor($width, $height); 
            imagecopyresampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY); 
            imagejpeg($images_fin, $upload_path); //ชื่อไฟล์ใหม่ 
            imagedestroy($images_orig);
            imagedestroy($images_fin);
        }
        else {
            echo '<script>
                    alert("ไม่สามารถอัพโหลดรูปภาพได้");
                    window.location="frm_treeowner_add.php";
                  </script>';
            exit();
        }
        
        $owner_image = $new_image_name;
        //end upload image

    //คำสั่ง sql
    $sql = "INSERT INTO tree_owner (treeowner_name,treeowner_address,treeowner_age, treeowner_education, 
                    treeowner_career, treeowner_revenue, treeowner_health, treeowner_image, treeowner_lat, treeowner_lng)
                    VALUES ('$treeowner_name', '$treeowner_address', '$treeowner_age', '$treeowner_education', '$treeowner_career', 
                    '$treeowner_revenue', '$treeowner_health', '$treeowner_image', '$treeowner_lat', '$treeowner_lng') ";
    $result = pg_query($db, $sql);

    //check 
    if ($result) {
        //echo "Complete";
        header("Location: treeowner_manage.php");
    } else {
        echo pg_last_error($db);
    }

    pg_close($db);
}

