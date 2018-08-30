<?php

    require '../connect/connectdb.php';
   
    //รับค่าตัวแปรจากฟอร์ม
    $treeplace_id = $_POST['treeplace_id'];
    $treeowner_id = $_POST['treeowner_id'];
    $treename_id = $_POST['treename_id'];
    $treeplace_lat = $_POST['treeplace_lat'];
    $treeplace_lng = $_POST['treeplace_lng'];
        
    //upload image
    $image = $_FILES['treeplace_herbimg']['name'];        
    $ext = pathinfo(($image), PATHINFO_EXTENSION); //นามสกุลของไฟล์
    $new_image_name = 'img_' . uniqid() . "." . $ext;
    $image_path = '../images/';
    $upload_path = $image_path . $new_image_name;
    //uploading
    $sucess = move_uploaded_file($_FILES['treeplace_herbimg']['tmp_name'], $upload_path);
        
    if ($sucess == TRUE) {
        $size = getimagesize($upload_path);
        $width = 500; //*** Fix Width & Heigh (Autu caculate) ***//
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
        echo $_FILES['treeplace_herbimg']['error'];
        exit();
    }
        
    $place_herbimg = $new_image_name;
    //end upload image
        
    //คำสั่ง sql
    $sql = "INSERT INTO tree_place (treeplace_id, treeowner_id, treename_id,  treeplace_lat, treeplace_lng, treeplace_herbimg)
            VALUES ('$treeplace_id', '$treeowner_id', '$treename_id',  '$treeplace_lat', '$treeplace_lng', '$treeplace_herbimg') ";
    $result = pg_query($db, $sql);
        
    //check 
    if($result){
        header("Location: treeplace_manage.php");
    } 
    else {
        echo pg_last_error($db);
    }
        
    pg_close($db);