<?php

    require '../connect/connectdb.php';
    
    $treetype_id = $_POST['leaf_id'];
    $treetype_name = $_POST['leaf_name'];
  
    
    //คำสั่ง sql        
        $sql = "INSERT INTO leaf (leaf_id, leaf_name) 
                VALUES ('$treetype_id', '$treetype_name') 
               ";
        $result = pg_query($db, $sql);
        
        //check 
        if($result){
            //echo "Complete";
            header("Location: tree_leaf_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);

