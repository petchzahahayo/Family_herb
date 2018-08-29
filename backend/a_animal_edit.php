<?php

    require '../connect/connectdb.php';

    //รับค่าตัวแปรจากฟอร์ม
    $treedata_id = $_POST['treedata_id'];
    $treetype_id = $_POST['treetype_id'];
    $treename_id = $_POST['treename_id'];
    $treedata_name_eng = $_POST['treedata_name_eng'];
    $treedata_name_sci = $_POST['treedata_name_sci'];
    $treedata_hight = $_POST['treedata_hight'];
    $treedata_wideth = $_POST['treedata_wideth'];
    $treedata_radius = $_POST['treedata_radius'];
    $treedata_detail = $_POST['treedata_detail'];
    //คำสั่ง sql เพื่อ update ข้อมูล
    $sql = "UPDATE tree_data 
                SET treetype_id = '$treetype_id',
                treename_id='$treename_id', 
                treedata_name_eng='$treedata_name_eng', 
                treedata_name_sci='$treedata_name_sci',
                treedata_hight= '$treedata_hight',
                treedata_wideth='$treedata_wideth',
                treedata_radius='$treedata_radius',  
                treedata_detail='$treedata_detail', 
               
                WHERE treedata_id='$treedata_id' ";
    $result = pg_query($sql);

    if ($result) {
        //echo "Upload Complete";
        header("location: a_animal_manage.php");
    } else {
        echo "Error = " . pg_last_error($db);
    }

    pg_close($db);

        
        
        