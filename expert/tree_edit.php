<?php

    require '../connect/connectdb.php';

    //รับค่าตัวแปรจากฟอร์ม
    $treedata_id = $_POST['treedata_id'];
    $treetype_id = $_POST['treetype_id'];
    $treename_id = $_POST['treename_id'];
    $treedata_name_eng = $_POST['treedata_name_eng'];
    $treedata_name_sci = $_POST['treedata_name_sci'];
    $treedata_detail = $_POST['treedata_detail'];
    $data_hight = $_POST['data_hight'];
    $data_wideth = $_POST['data_wideth'];
    $data_radius = $_POST['data_radius'];
    /*$data_medicine = $_POST['data_medicine'];
    $data_properties = $_POST['data_properties'];*/

    //คำสั่ง sql เพื่อ update ข้อมูล
    $sql = "UPDATE tree_data 
                SET type_id = '$treetype_id',
                treename_id='$treename_id', 
                treedata_name_eng='$treedata_name_eng', 
                treedata_name_sci='$treedata_name_sci',
                treedata_detail='$treedata_detail',
                data_hight='$data_hight',
                data_wideth='$data_wideth',
                data_radius='$data_radius', 
                data_medicine='$data_medicine', 
                data_properties='$data_properties'

                WHERE treedata_id='$treedata_id' ";
    $result = pg_query($sql);

    if ($result) {
        //echo "Upload Complete";
        header("location: tree_manage.php");
    } else {
        echo "Error = " . pg_last_error($db);
    }

    pg_close($db);

        
        
        