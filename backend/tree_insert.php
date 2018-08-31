<?php

        require '../connect/connectdb.php';
        
        //รับค่าตัวแปรจากฟอร์ม
        $treedata_id = $_POST['treedata_id'];
        $treetype_id = $_POST['treetype_id'];
        $treename_id = $_POST['treename_id'];
        $treedata_name_eng = $_POST['treedata_name_eng'];
        $treedata_name_sci = $_POST['treedata_name_sci'];
        $treedata_detail = $_POST['treedata_detail'];
        $treedata_hight = $_POST['treedata_hight'];
        $treedata_wideth = $_POST['treedata_wideth'];
        $treedata_radius = $_POST['treedata_radius'];
       
        
        //คำสั่ง sql
        $sql = "INSERT INTO tree_data (treedata_id, treetype_id, treename_id, treedata_name_eng, treedata_name_sci, treedata_detail, treedata_hight, treedata_wideth,treedata_radius) 
                VALUES ('$treedata_id', '$treetype_id', '$treename_id', '$treedata_name_eng', '$treedata_name_sci', '$treedata_detail', '$treedata_hight', '$treedata_wideth','$treedata_radius')";
        $result = pg_query($db, $sql);
        
        //check 
        if($result){
            //echo "Complete";
            header("Location: tree_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);