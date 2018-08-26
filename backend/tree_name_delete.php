<?php

    require 'header_admin.php';      
    
    $treename_id = $_GET['treename_id'];
    
    $sql_treename = "SELECT * FROM tree_name WHERE treename_id='$treename_id'";
    $res_treename = pg_query($db, $sql_treename);
    $row_treename = pg_fetch_array($res_treename);
    //echo $row_name['name_th'];
    //sql DELETE
    $sql_del_treename = "DELETE FROM tree_name WHERE treename_id='$treename_id'";
    $res_del_treename = pg_query($db, $sql_del_treename);
    
    if ($res_del_treename) {
        header ("Location: tree_name_manage.php");
    } 
    else {
        echo "Can not Delete";
    }
    