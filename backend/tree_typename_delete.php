<?php
    ob_start();
    require 'header_admin.php'; 
    
    $treetype_id = $_GET['treetype_id'];
    
    //sql DELETE
    $sql_del_typename = "DELETE FROM tree_typename WHERE treetype_id='$treetype_id'";
    $res_del_typename = pg_query($db, $sql_del_typename);
    
    if ($res_del_typename) {
        header ("Location: tree_typename_manage.php");
    } 
    else {
        echo "Can not Delete";
        //header ("Location: herb_typename_manage.php");
    }