<?php
    ob_start();
    require 'header_admin.php'; 
    
    $leaf_id = $_GET['leaf_id'];
    
    //sql DELETE
    $sql_del_leaf = "DELETE FROM leaf_name WHERE leaf_id='$leaf_id'";
    $res_del_leaf = pg_query($db, $sql_del_leaf);
    
    if ($res_del_leaf) {
        header ("Location: tree_leaf_manage.php");
    } 
    else {
        echo "Can not Delete";
        //header ("Location: herb_typename_manage.php");
    }