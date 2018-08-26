<?php

    require '../connect/connectdb.php';
    
    //รับข้อมูล
    $treename_id = $_POST['treename_id'];
    $treename_th = $_POST['treename_th'];
    $treealphabet_id = $_POST['treealphabet_id'];
    
    //sql Update
    $sql_up_treename = "UPDATE tree_name
                    SET treename_id='$treename_id', 
                        treename_th='$treename_th',
                        treealphabet_id=$treealphabet_id
                        WHERE treename_id='$treename_id'
                   ";
    $res_up_treename = pg_query($db, $sql_up_treename);
    
    if ($res_up_treename) {
        header ("Location: tree_name_manage.php");
    } 
    else {
        echo "Can not Update";
    }
    

