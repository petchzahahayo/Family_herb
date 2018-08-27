<?php 
        require 'header_expert.php';
        
        //รับข้อมูล
        $treedata_id = $_GET['treedata_id'];

        $sql = "select * from tree_data 
                INNER JOIN tree_typename
                ON tree_data.treetype_id = tree_typename.treetype_id
                INNER JOIN tree_name
                ON tree_data.treename_id = tree_name.treename_id
                WHERE treedata_id='$treedata_id'";
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
            <h2>ข้อมูลต้นไม้</h2>
            <table class="table table-bordered">
                
                <!-- show data -->
                <?php while ($row = pg_fetch_array($result)){ ?>
                
                <tr>
                    <th class="info">ประเภทต้นไม้</th>
                    <td><?php echo $row['treetype_name']; ?></td>
                </tr>                               
                
                <tr>
                    <th class="info">ชื่อต้นไม้</th>
                    <td><?php echo $row['treename_th']; ?></td>
                </tr>

                <tr>
                    <th class="info">ชื่อภาษาอังกฤษ</th>
                    <td><?php echo $row['treedata_name_eng']; ?></td>
                </tr>
                
                <tr>
                    <th class="info">ชื่อวิทยาศาสตร์</th>
                    <td><?php echo $row['treedata_name_sci']; ?></td>
                </tr>

                <tr>
                    <th class="info">ความสูง</th>
                    <td><?php echo $row['treedata_hight']; ?></td>
                </tr>
                
                <tr>
                    <th class="info">ความกว้าง</th>
                    <td><?php echo $row['treedata_wideth']; ?></td>
                </tr>

                <tr>
                    <th class="info">เส้นรอบวง</th>
                    <td><?php echo $row['treedata_radius']; ?></td>
                </tr>

                <tr>
                    <th class="info">ลักษณะของต้นไม้</th>
                    <td><?php echo $row['treedata_detail']; ?></td>
                </tr>

                
                
                
                <?php } ?>
            </table>
            <!--
            <a href="frm_herb_add.php" class="btn btn-primary" >
                <span class="glyphicon glyphicon-plus"> เพิ่มสมุนไพร</span>
            </a>-->
            <a href="tree_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
        </div>    
    </body>
</html>

