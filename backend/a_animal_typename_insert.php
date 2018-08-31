<?php

    require '../connect/connectdb.php';
    
    $animal_id = $_POST['animal_type_id'];
    $animal_name = $_POST['animal_name_type'];
    $animal_details = $_POST['animal_type_more'];
    
    //คำสั่ง sql        
        $sql = "INSERT INTO animal_type (animal_type_id, animal_name_type, animal_type_more) 
                VALUES ('$animal_id', '$animal_name', '$animal_details') 
               ";
        $result = pg_query($db, $sql);
        
        //check 
        if($result){
            //echo "Complete";
            header("Location: a_animal_typename_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);

