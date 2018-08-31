
<?php
ob_start();
    require 'header_admin.php'; 
    
    $animal_type_id = $_GET['animal_type_id'];

    //sql DELETE
    $sql_del_typename = "DELETE FROM animal_type WHERE animal_type_id='$animal_type_id'";
    $res_del_typename = pg_query($db, $sql_del_typename);
    
    if ($res_del_typename) {
        
      header ("Location: a_animal_typename_manage.php");
    } 
    else {
        echo "Can not Delete";
        //header ("Location: herb_typename_manage.php");
    }