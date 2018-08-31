<?php

        require '../connect/connectdb.php';
        
        //รับค่าตัวแปรจากฟอร์ม
        $animal_id = $_POST['treename_id'];
        $animal_name = $_POST['treename_th'];
        
        //คำสั่ง sql        
        $sql = "INSERT INTO animal_tumbon (animal_tumbon_id, animal_tumbon_name) 
                VALUES ('$animal_id', '$animal_name') 
               ";
        $result = pg_query($db, $sql);
        
        //check 
        if($result){
            //echo "Complete";
            header("Location: a_animal_tumbon_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);