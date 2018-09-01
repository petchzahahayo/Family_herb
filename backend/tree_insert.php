<?php

        require '../connect/connectdb.php';
        
        //รับค่าตัวแปรจากฟอร์ม
        $treedata_id = $_POST['treedata_id'];
        $treetype_id = $_POST['treetype_id'];
        $treename_id = $_POST['treename_id'];
        $treedata_name_eng = $_POST['treedata_name_eng'];
        $treedata_name_sci = $_POST['treedata_name_sci'];
        $treedata_detail = $_POST['treedata_detail'];
        
        
        //คำสั่ง sql
        $sql = "INSERT INTO tree_data (treedata_id, treetype_id, treename_id, treedata_name_eng, treedata_name_sci, treedata_detail ) 
                VALUES ('$treedata_id', '$treetype_id', '$treename_id', '$treedata_name_eng', '$treedata_name_sci', '$treedata_detail')";
        $result = pg_query($db, $sql);
        
        //check 
        if($result){
            //echo "Complete";
            header("Location: tree_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);