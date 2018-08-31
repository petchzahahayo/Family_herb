<?php

        require '../connect/connectdb.php';
        
        //รับค่าตัวแปรจากฟอร์ม
        $data_id = $_GET['animal_data_id'];
        $data_type_id = $_GET['animal_type_id_animal_data'];  //เชื่อใตาราง
        $dataname_th = $_GET['animal_name_th'];
        $dataname_eng = $_GET['animal_name_eng'];
        $dataname_science = $_GET['animal_name_science'];
        $data_high = $_GET['animal_high'];
        $data_long = $_GET['animal_long'];
        $data_detail = $_GET['animal_detail'];
        
        //คำสั่ง sql
        $sql = "INSERT INTO animal_data (animal_data_id, animal_name_th, animal_name_eng, animal_name_science,animal_type_id_animal_data, animal_high, animal_long, animal_detail) 
                VALUES ('$data_id', '$dataname_th', '$dataname_eng', '$dataname_science', '$data_type_id', '$data_high', '$data_long', '$data_detail' )";
        $result = pg_query($db, $sql);
        
        //check 
        if($result){
            //echo "Complete";
            header("Location: a_animal_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);