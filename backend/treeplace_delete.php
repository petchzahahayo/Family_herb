<?php
        
        require '../connect/connectdb.php';
    
        //รับค่า h_id
        $treeplace_id = $_GET['treeplace_id'];
        
        //คำสั่ง sql เพื่อลบ
        $sql = "DELETE FROM tree_place WHERE treeplace_id='$treeplace_id'";
        $result = pg_query($db, $sql);
        
        if($result){
            header("location: placetree_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);

