<?php
ob_start();
    require 'header_admin.php';      
    
    $animal_tumbon_id = $_GET['animal_tumbon_id'];
    
    //sql DELETE
    $sql_del_treename = "DELETE FROM animal_tumbon WHERE animal_tumbon_id='$animal_tumbon_id'";
    $res_del_treename = pg_query($db, $sql_del_treename);
    
    if ($res_del_treename) {
        header ("Location: a_animal_tumbon_manage.php");
    } 
    else {
        echo "Can not Delete";
    }
    