<?php

        require '../connect/connectdb.php';
        
        //รับค่าตัวแปรจากฟอร์ม
        $collect_id = $_POST['animal_collect_id'];
        $animal_id = $_POST['animal_data_id_collect'];
        @$tumbon_id = $_POST['animal_tumbon_id_collect'];
        @$collect_lat = $_POST['collect_lat'];
        @$collect_lng = $_POST['collect_lng'];
         @$collect_img = $_POST['collect_img'];
        
        //upload image
        $ext = pathinfo(($_FILES['collect_img']['name']), PATHINFO_EXTENSION); //นามสกุลของไฟล์
        $new_image_name = 'img_animal_' . uniqid() . "." . $ext;
        $image_path = '../images/';
        $upload_path = $image_path . $new_image_name;
        //uploading
        $sucess = move_uploaded_file($_FILES['collect_img']['tmp_name'], $upload_path);
        
        if ($sucess==FALSE) {
            echo "ไม่สามารถเพิ่มรูปภาพได้";
            exit();
        }
        

        $collect_img = $new_image_name;
        //end upload image
        
        //คำสั่ง sql
        $sql = "UPDATE animal_collect 
        
        SET animal_tumbon_td_collect = $tumbon_id
            animal_data_id_collect = $collect_id
            collect_img = $collect_img
        WHERE animal_collect_id = $collect_id
         ";
        $result = pg_query($db, $sql);
        
        //check 
        if($result){
            //echo "Complete";
            header("a_placeanimal_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);

