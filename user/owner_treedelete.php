<?php
        
        require '../connect/connectdb.php';
        require 'treefunction.php';
    
        //รับค่า h_id
        $treeowner_id = $_GET['treeowner_id'];
        
        //delete image
        $sql_image = "SELECT treeowner_image FROM tree_owner WHERE treeowner_id='$treeowner_id'";
        $path = 'image_treeowner/';
        deleteImage($sql_image, $path);
        
        //คำสั่ง sql เพื่อลบ
        $sql = "DELETE FROM tree_owner WHERE treeowner_id='$treeowner_id'";
        $result = pg_query($db, $sql);
        
        if($result){
            header("location: treeowner_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);

