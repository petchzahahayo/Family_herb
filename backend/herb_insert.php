<?php
        require '../connect/connectdb.php';
        
        //รับค่าตัวแปรจากฟอร์ม
        $data_id = $_POST['data_id'];
        $type_id = $_POST['type_id'];
        $name_id = $_POST['name_id'];
        $data_name_eng = $_POST['data_name_eng'];
        $data_name_sci = $_POST['data_name_sci'];
        $data_detail = $_POST['data_detail'];
        $data_medicine = $_POST['data_medicine'];
        $data_properties = $_POST['data_properties'];
        $po_id =  $_POST['po_id'];
        
        //คำสั่ง sql
        $sql = "INSERT INTO herb_data (data_id, type_id, name_id, data_name_eng, data_name_sci, data_detail, data_medicine, data_properties, po_id) 
                VALUES ('$data_id', '$type_id', '$name_id', '$data_name_eng', '$data_name_sci', '$data_detail', '$data_medicine', '$data_properties', '$po_id')";
        $result = pg_query($db, $sql);
        
        //check 
        if($result){
            //echo "Complete";
            header("Location: herb_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);