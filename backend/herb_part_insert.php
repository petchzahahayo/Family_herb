<?php

    require '../connect/connectdb.php';
    
    $part_id = $_POST['part_id'];
    $part_name = $_POST['part_name'];
    
    
    //คำสั่ง sql        
        $sql = "INSERT INTO herb_part (part_id, part_name) 
                VALUES ('$part_id', '$part_name') 
               ";
        $result = pg_query($db, $sql);
        
        //check 
        if($result){
            //echo "Complete";
            header("Location: herb_part_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);

