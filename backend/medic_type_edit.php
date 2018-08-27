<?php

    require '../connect/connectdb.php';
    
    //รับค่า
    $type_id = $_POST['type_id'];
    $type_name = $_POST['type_name'];
    
    //sql update
    $sql_up_typename = "UPDATE medicine_type 
                        SET type_name='$type_name'         
                        WHERE type_id='$type_id'";
    $res_up_typename = pg_query($db, $sql_up_typename);
    
    if ($res_up_typename) {
         echo '<script>
                alert("บันทึกข้อมูลเรียบร้อย");
                window.location="medic_type_manage.php";
              </script>';
        //header ("Location: herb_typename_manage.php");
    } 
    else {
        echo "Can not Update";
    }