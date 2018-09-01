<?php

    require '../connect/connectdb.php';
    
    //รับค่า
    $part_id = $_POST['part_id'];
    $part_name = $_POST['part_name'];
    
    //sql update
    $sql_up_partname = "UPDATE herb_part 
                        SET part_name='$part_name'         
                        WHERE part_id='$part_id'";
    $res_up_partname = pg_query($db, $sql_up_partname);
    
    if ($res_up_partname) {
         echo '<script>
                alert("บันทึกข้อมูลเรียบร้อย");
                window.location="herb_part_manage.php";
              </script>';
        //header ("Location: herb_typename_manage.php");
    } 
    else {
        echo "Can not Update";
    }