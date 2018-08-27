<?php

    require '../connect/connectdb.php';

    //upload image      
if (is_uploaded_file($_FILES['medicine_img']['tmp_name'])) {
    //รับค่าตัวแปรจากฟอร์ม 
        $medic_id = $_POST['medicine_id'];
        $medic_name = $_POST['medicine_name'];
        $name_id = $_POST['name_id'];
        $medic_data = $_POST['medicine_data'];
        $part_id = $_POST['part_id'];
        $medic_type = $_POST['type_id'];

    //delete old image
    $sql_image = "SELECT medicine_img FROM medicine WHERE medicine_id='$medic_id'";
    $res_image = pg_query($db, $sql_image);
    $row_image = pg_fetch_row($res_image);
    $image_old = $row_image[0];

    unlink("../images/" . $image_old);

    //update image
    $image_ext = pathinfo(basename($_FILES['medicine_img']['name']), PATHINFO_EXTENSION);
    $new_image_name = 'img_' . uniqid() . "." . $image_ext;
    $image_path = "../images/";
    $img_upload_path = $image_path . $new_image_name;
    $success = move_uploaded_file($_FILES['medicine_img']['tmp_name'], $img_upload_path);
    $medicine_img = $new_image_name;
    //end upload image  
      
    //คำสั่ง sql เพื่อ update ข้อมูล
    $sql = "UPDATE medicine
    SET medicine_name='$medic_name' ,
    name_id='$name_id',
    medicine_data='$medic_data',
    part_id='$part_id',
    type_id ='$medic_type',
    medicine_img='$medicine_img'
    WHERE medicine_id='$medic_id' ";
    $result = pg_query($sql);


    if ($result) {
        //echo "Upload Complete";
        header("location: medic_manage.php");
    } else {
        echo "Error = " . pg_last_error($db);
    }

    pg_close($db);


} else
{

    //รับค่าตัวแปรจากฟอร์ม
        $medic_id = $_POST['medicine_id'];
        $medic_name = $_POST['medicine_name'];
        $name_id = $_POST['name_id'];
        $medic_data = $_POST['medicine_data'];
        $part_id = $_POST['part_id'];
        $medic_type = $_POST['type_id'];

    //คำสั่ง sql เพื่อ update ข้อมูล
    $sql = "UPDATE medicine
                SET medicine_name='$medic_name' ,
                name_id='$name_id',
                medicine_data='$medic_data',
                part_id='$part_id',
                type_id ='$medic_type'
                WHERE medicine_id='$medic_id' ";
    $result = pg_query($sql);

    if ($result) {
        //echo "Upload Complete";
        header("location: medic_manage.php");
    } else {
        echo "Error = " . pg_last_error($db);
    }

    pg_close($db);

        
}       
        