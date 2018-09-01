<?php 
        require 'header_user.php';
        
        //รับข้อมูล
        $medic_id = $_GET['medicine_id'];

        $sql = "select * from medicine 
        INNER JOIN medicine_type
        ON medicine.type_id = medicine_type.type_id
        Inner join herb_part
        on medicine.part_id = herb_part.part_id
        inner join herb_name 
        on medicine.name_id = herb_name.name_id
                WHERE medicine_id='$medic_id'";
        $result = pg_query($db, $sql);       
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            <h2>ข้อมูลยา</h2>
            <table class="table table-bordered">
                
                <!-- show data -->
                <?php while ($row = pg_fetch_array($result)){ ?>

                  <tr>
                    <th class="info">ชื่อสมุนไพร</th>
                    <td><?php echo $row['name_th']; ?></td>
                </tr>

                  <tr>
                    <th class="info">ชื่อยา</th>
                    <td><?php echo $row['medicine_name']; ?></td>
                </tr>
                
                <tr>
                    <th class="info">ข้อมูลยา</th>
                    <td><?php echo $row['medicine_data']; ?></td>
                </tr>                               
                
              
                <tr>
                    <th class="info">ส่วนของสมุนไพร</th>
                    <td><?php echo $row['part_name']; ?></td>
                </tr>
                
                <tr>
                    <th class="info">ประเภท</th>
                    <td><?php echo $row['type_name']; ?></td>
                </tr>
                
               
                <?php } ?>
            </table>
            <!--
            <a href="frm_herb_add.php" class="btn btn-primary" >
                <span class="glyphicon glyphicon-plus"> เพิ่มสมุนไพร</span>
            </a>-->
            <a href="medic_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
        </div>    
    </body>
</html>

