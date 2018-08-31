<?php

    require '../connect/connectdb.php';
    
    //รับข้อมูล
    $treename_id = $_POST['animal_tumbon_id'];
    $treename_th = $_POST['animal_tumbon_name'];
    
    //sql Update
    $sql_up_treename = "UPDATE animal_tumbon
                    SET animal_tumbon_id='$treename_id', 
                        animal_tumbon_name='$treename_th',
                        WHERE animal_tumbon_id='$treename_id'
                   ";
    $res_up_treename = pg_query($db, $sql_up_treename);
    
    if ($res_up_treename) {
        header ("Location: a_animal_tumbon_manage.php");
    } 
    else {
        echo "Can not Update";
    }
    

