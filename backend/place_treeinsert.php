<?php

        require '../connect/connectdb.php';
        
        //รับค่าตัวแปรจากฟอร์ม
        $treeplace_id = $_POST['treeplace_id'];
        $treeowner_id = $_POST['treeowner_id'];
        $treealphabet = $_POST['treename_id'];
        $treeplace_lat = $_POST['treeplace_lat'];
        $treeplace_lng = $_POST['treeplace_lng'];
        $treeplace_hight = $_POST['treeplace_hight'];
        $treeplace_wideth = $_POST['treeplace_wideth'];
        $treeplace_radius = $_POST['treeplace_radius'];
       
        
        //upload image
        $ext = pathinfo(($_FILES['treeplace_herbimg']['name']), PATHINFO_EXTENSION); //นามสกุลของไฟล์
        $new_image_name = 'img_' . uniqid() . "." . $ext;
        $image_path = '../images/';
        $upload_path = $image_path . $new_image_name;
        //uploading
        $sucess = move_uploaded_file($_FILES['treeplace_herbimg']['tmp_name'], $upload_path);
        
        if ($sucess==FALSE) {
            echo "ไม่สามารถเพิ่มรูปภาพได้";
            exit();
        }
        
        $treeplace_herbimg = $new_image_name;
        //end upload image
        
        //คำสั่ง sql
        $sql = "INSERT INTO tree_place (treeplace_id, treeowner_id, treename_id,  treeplace_lat, treeplace_lng, treeplace_herbimg,treeplace_hight,treeplace_wideth,treeplace_radius)"
                . "VALUES ('$treeplace_id','$treeowner_id', '$treealphabet',  '$treeplace_lat', '$treeplace_lng', '$treeplace_herbimg','$treeplace_hight','$treeplace_wideth','$treeplace_radius') ";
        $result = pg_query($db, $sql);
        
        //check 
        if($result){
            //echo "Complete";
            header("Location: placetree_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);

