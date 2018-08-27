<?php

    require '../connect/connectdb.php';
    
    $type_id = $_POST['type_id'];
    $type_name = $_POST['type_name'];
   
    
    //คำสั่ง sql        
        $sql = "INSERT INTO medicine_type (type_id, type_name) 
                VALUES ('$type_id', '$type_name') 
               ";
        $result = pg_query($db, $sql);
        
        //check 
        if($result){
            //echo "Complete";
            header("Location: medic_type_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);

