<?php

        require '../connect/connectdb.php';
        
        //รับค่าตัวแปรจากฟอร์ม
        $medic_id = $_POST['medicine_id'];
        $medic_name = $_POST['medicine_name'];
        $name_id = $_POST['name_id'];
        $medic_data = $_POST['medicine_data'];
        $part_id = $_POST['part_id'];
        $medic_type = $_POST['tpye_id'];
         
        //คำสั่ง sql
        $sql = "INSERT INTO medicine (medicine_id, medicine_name, name_id, medicine_data, part_id, tpye_id) 
                VALUES ('$medic_id', '$medic_name', '$name_id', '$medic_data', '$part_id', '$medic_type')";
        $result = pg_query($db, $sql);
        
        //check 
        if($result){
            //echo "Complete";
            header("Location: medic_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);