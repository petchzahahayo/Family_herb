<?php

    require '../connect/connectdb.php';
    
    //รับค่า
    $treetype_id = $_POST['treetype_id'];
    $treetype_name = $_POST['treetype_name'];
    $treetype_details = $_POST['treetype_details'];
    
    //sql update
    $sql_up_treetypename = "UPDATE tree_typename 
                        SET treetype_name='$treetype_name',
                            treetype_details='$treetype_details'
                        WHERE treetype_id='$treetype_id'";
    $res_up_treetypename = pg_query($db, $sql_up_treetypename);
    
    if ($res_up_treetypename) {
         echo '<script>
                alert("บันทึกข้อมูลเรียบร้อย");
                window.location="a_animal_typename_manage.php";
              </script>';
        //header ("Location: herb_typename_manage.php");
    } 
    else {
        echo "Can not Update";
    }