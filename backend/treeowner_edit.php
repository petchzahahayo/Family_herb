<?php

require '../connect/connectdb.php';
require 'function.php';

//upload image      
if (is_uploaded_file($_FILES['treeowner_image']['tmp_name'])) {
    
    //รับค่าตัวแปรจากฟอร์ม frm_user_edit
    $treeowner_id = $_POST['treeowner_id'];
    $treeowner_name = $_POST['treeowner_name'];
    $treeowner_address = $_POST['treeowner_address'];
    $treeowner_age = $_POST['treeowner_age'];
    $treeowner_education = $_POST['treeowner_education'];
    $treeowner_career = $_POST['treeowner_career'];
    $treeowner_revenue = $_POST['treeowner_revenue'];
    $treeowner_health = $_POST['treeowner_health'];
    $treeowner_career2 = $_POST['treeowner_career2'];
    $treeowner_health2 = $_POST['treeowner_health2'];

    //edit image
    $sql_image = "SELECT treeowner_image FROM tree_owner WHERE treeowner_id='$treeowner_id'";
    $res_image = pg_query($db, $sql_image);
    $row_image = pg_fetch_row($res_image);
    $image_old = $row_image[0];

    unlink("../images/treeowner/" . $image_old);
    
    //update image
    $image_ext = pathinfo(basename($_FILES['treeowner_image']['name']), PATHINFO_EXTENSION);
    $new_image_name = 'img_' . uniqid() . "." . $image_ext;
    $image_path = "../images/treeowner/";
    $img_upload_path = $image_path . $new_image_name;
    $success = move_uploaded_file($_FILES['treeowner_image']['tmp_name'], $img_upload_path);
    $treeowner_image = $new_image_name;
    //end upload image  

    //คำสั่ง sql เพื่อ update ข้อมูล
    $sql = "UPDATE tree_owner 
                    SET treeowner_name='$treeowner_name',
                        treeowner_address='$treeowner_address', 
                        treeowner_age = '$treeowner_age',
                        treeowner_education = '$treeowner_education',
                        treeowner_career = '$treeowner_career',
                        treeowner_revenue = '$treeowner_revenue',
                        treeowner_health = '$treeowner_health',
                        treeowner_image = '$treeowner_image',
                        treeowner_career2 = '$treeowner_career2',
                        treeowner_health2 = '$treeowner_health2'    
                    WHERE treeowner_id='$treeowner_id'";
    $result = pg_query($sql);

    if ($result) {
        //echo "Upload Complete";
        header("location: treeowner_manage.php");
    } else {
        echo "Error = " . pg_last_error($db);
    }

    pg_close($db);
}
else 
{
    //รับค่าตัวแปรจากฟอร์ม frm_user_edit
    $treeowner_id = $_POST['treeowner_id'];
    $treeowner_name = $_POST['treeowner_name'];
    $treeowner_address = $_POST['treeowner_address'];
    $treeowner_age = $_POST['treeowner_age'];
    $treeowner_education = $_POST['treeowner_education'];
    $treeowner_career = $_POST['treeowner_career'];
    $treeowner_revenue = $_POST['treeowner_revenue'];
    $treeowner_health = $_POST['treeowner_health'];
    $treeowner_career2 = $_POST['treeowner_career2'];
    $treeowner_health2 = $_POST['treeowner_health2'];
    
    //คำสั่ง sql เพื่อ update ข้อมูล
    $sql = "UPDATE tree_owner 
                    SET treeowner_name='$treeowner_name',
                        treeowner_address='$treeowner_address', 
                        treeowner_age = '$treeowner_age',
                        treeowner_education = '$treeowner_education',
                        treeowner_career = '$treeowner_career',
                        treeowner_revenue = '$treeowner_revenue',
                        treeowner_health = '$treeowner_health',
                        treeowner_career2 = '$treeowner_career2',
                        treeowner_health2 = '$treeowner_health2'    
                    WHERE treeowner_id='$treeowner_id'";
    $result = pg_query($sql);

    if ($result) {
        //echo "Upload Complete";
        header("location: treeowner_manage.php");
    } else {
        echo "Error = " . pg_last_error($db);
    }

    pg_close($db);
}
        