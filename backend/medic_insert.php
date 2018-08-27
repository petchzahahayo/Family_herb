<?php

        require '../connect/connectdb.php';
        
        //รับค่าตัวแปรจากฟอร์ม
        $medic_id = $_POST['medicine_id'];
        $medic_name = $_POST['medicine_name'];
        $name_id = $_POST['name_id'];
        $medic_data = $_POST['medicine_data'];
        $part_id = $_POST['part_id'];
        $medic_type = $_POST['type_id'];

         //upload image
         $ext = pathinfo(($_FILES['medicine_img']['name']), PATHINFO_EXTENSION); //นามสกุลของไฟล์
         $new_image_name = 'img_' . uniqid() . "." . $ext;
         $image_path = '../images/';
         $upload_path = $image_path . $new_image_name;
         //uploading
         $sucess = move_uploaded_file($_FILES['medicine_img']['tmp_name'], $upload_path);
         
         if ($sucess==FALSE) {
             echo "ไม่สามารถเพิ่มรูปภาพได้";
             exit();
         }
         
         $medic_img = $new_image_name;
         //end upload image
         
        //คำสั่ง sql
        $sql = "INSERT INTO medicine (medicine_id, medicine_name, name_id,  medicine_data, part_id, type_id, medicine_img) 
                VALUES ('$medic_id', '$medic_name', '$name_id',   '$medic_data', '$part_id', '$medic_type', '$medic_img')";
        $result = pg_query($db, $sql);
        
        //check 
        if($result){
            //echo "Complete";
            header("Location: medic_manage.php");
        } else {
            echo pg_last_error($db);
        }
        
        pg_close($db);