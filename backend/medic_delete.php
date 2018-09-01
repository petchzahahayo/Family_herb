<?php
        require '../connect/connectdb.php';
        
        //รับค่า h_id
        $medicine_id = $_GET['medicine_id'];

        //sqlDelete Image
        $sql_image = "SELECT medicine_img FROM medicine WHERE medicine_id='$medicine_id'";
        $res_image = pg_query($db, $sql_image);
        $data_image = pg_fetch_row($res_image);
        $file_name = $data_image[0];
        
        unlink("../images/" . $file_name);
        
        //คำสั่ง sql เพื่อลบ
        $sql_delete = "DELETE FROM medicine WHERE medicine_id='$medicine_id'";
        $result_delete = pg_query($db, $sql_delete);
        
        if($result_delete){
            header("location: medic_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);