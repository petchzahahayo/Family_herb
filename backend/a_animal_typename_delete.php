<?php

    require 'header_admin.php'; 
    
    $treetype_id = $_GET['treetype_id'];
    
    //sql DELETE
    $sql_del_treetypename = "DELETE FROM tree_typename WHERE treetype_id='$treetype_id'";
    $res_del_treetypename = pg_query($db, $sql_del_treetypename);
    
    if ($res_del_treetypename) {
        header ("Location: a_animal_typename_manage.php");
    } 
    else {
        echo "Can not Delete";
        //header ("Location: herb_typename_manage.php");
    }