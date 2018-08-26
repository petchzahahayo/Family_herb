<?php

    require '../connect/connectdb.php';
    
    $treetype_id = $_POST['treetype_id'];
    $treetype_name = $_POST['treetype_name'];
    $treetype_details = $_POST['treetype_details'];
    
    //คำสั่ง sql        
        $sql = "INSERT INTO tree_typename (treetype_id, treetype_name, treetype_details) 
                VALUES ('$treetype_id', '$treetype_name', '$treetype_details') 
               ";
        $result = pg_query($db, $sql);
        
        //check 
        if($result){
            //echo "Complete";
            header("Location: tree_typename_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);

