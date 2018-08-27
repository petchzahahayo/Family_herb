<?php

        require '../connect/connectdb.php';
        
        //รับค่าตัวแปรจากฟอร์ม
        $treename_id = $_POST['treename_id'];
        $treename_th = $_POST['treename_th'];
        $treealphabet_id = $_POST['treealphabet_id'];
        
        //คำสั่ง sql        
        $sql = "INSERT INTO tree_name (treename_id, treename_th, treealphabet_id) 
                VALUES ('$treename_id', '$treename_th','$treealphabet_id') 
               ";
        $result = pg_query($db, $sql);
        
        //check 
        if($result){
            //echo "Complete";
            header("Location: a_animal_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);