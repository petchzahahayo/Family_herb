<?php

    require 'header_admin.php'; 
    
    $part_id = $_GET['part_id'];
    
    //sql DELETE
    $sql_del_partname = "DELETE FROM herb_part WHERE part_id='$part_id'";
    $res_del_partname = pg_query($db, $sql_del_partname);
    
    if ($res_del_partname) {
        header ("Location: herb_part_manage.php");
    } 
    else {
        echo "Can not Delete";
        //header ("Location: herb_typename_manage.php");
    }