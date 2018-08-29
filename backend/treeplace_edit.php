<?php

require '../connect/connectdb.php';

//upload image      
if (is_uploaded_file($_FILES['treeplace_herbimg']['tmp_name'])) {
    //รับค่าตัวแปรจากฟอร์ม 
    $treeplace_id = $_POST['treeplace_id'];
    $treeowner_id = $_POST['treeowner_id'];
    $treename_id = $_POST['treename_id'];

    //delete old image
    $sql_image = "SELECT treeplace_herbimg FROM tree_place WHERE treeplace_id='$treeplace_id'";
    $res_image = pg_query($db, $sql_image);
    $row_image = pg_fetch_row($res_image);
    $image_old = $row_image[0];

    unlink("../images/" . $image_old);

    //update image
    $image_ext = pathinfo(basename($_FILES['treeplace_herbimg']['name']), PATHINFO_EXTENSION);
    $new_image_name = 'img_' . uniqid() . "." . $image_ext;
    $image_path = "../images/";
    $img_upload_path = $image_path . $new_image_name;
    $success = move_uploaded_file($_FILES['treeplace_herbimg']['tmp_name'], $img_upload_path);
    $place_herbimg = $new_image_name;
    //end upload image  
      
    //คำสั่ง sql เพื่อ update ข้อมูล
    $sql = "UPDATE tree_place 
                    SET treeowner_id='$treeowner_id',
                        treename_id = '$treename_id',
                        treeplace_herbimg = '$treeplace_herbimg'    
                    WHERE treeplace_id='$treeplace_id'";
    $result = pg_query($sql);


    if ($result) {
        //echo "Upload Complete";
        header("location: placetree_manage.php");
    } else {
        echo "Error = " . pg_last_error($db);
    }

    pg_close($db);
} 
else 
{
    //รับค่าตัวแปรจากฟอร์ม 
    $treeplace_id = $_POST['treeplace_id'];
    $treeowner_id = $_POST['treeowner_id'];
    $treename_id = $_POST['treename_id'];
    
    //คำสั่ง sql เพื่อ update ข้อมูล
    $sql = "UPDATE tree_place 
                    SET treeowner_id='$treeowner_id',
                        treename_id = '$treename_id' 
                    WHERE treeplace_id='$treeplace_id'";
    $result = pg_query($sql);


    if ($result) {
        //echo "Upload Complete";
        header("location: placetree_manage.php");
    } else {
        echo "Error = " . pg_last_error($db);
    }

    pg_close($db);
}
        