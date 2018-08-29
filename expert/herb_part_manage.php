<?php
    require 'header_expert.php';      
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <script>
            function comfirmDelete()
            {
                var answer = confirm("ต้องการลบข้อมูล");
                if (answer) {
                   alert('ลบข้อมูล'); 
                } 
            }
        </script>
        
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                   <!-- <a href="frm_herb_part_add.php" class="btn btn-primary" >
                        <span class="glyphicon glyphicon-plus"> เพิ่มส่วนที่ใช้</span>
                    </a> -->
                </div>
                
                <div class="col-md-6">
                    <a href="medic_manage.php" type="button" class="btn btn-success">
                        <span class="glyphicon glyphicon-th-list"> ข้อมูลยา</span>
                    </a>
                    <a href="medic_type_manage.php" type="button" class="btn btn-success">
                        <span class="glyphicon glyphicon-th-list"> รายชื่อประเภทยา</span>
                    </a>
                </div>
                
            </div>
            
            <h2>ส่วนของสมุนไพร</h2> 
            <table class="table table-bordered">
                <thead>
                    
                    <!-- แบ่งหน้า -->
                    <?php 
                        //กำหนดจำนวนหน้า
                        $perpage = 20;
                        
                        //เช็คว่าเป็นค่าว่างหรือไม่
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        $start = ($page - 1) * $perpage;

                        $sqlPage = "SELECT * FROM herb_part
                                    ORDER BY part_id ASC limit {$perpage} offset {$start}
                                   ";
                        $queryPage = pg_query($db, $sqlPage);
                    ?>
                    
                    <tr class="info">
                        <!--<th><center>#</center></th>    -->                    
                        <th><center>ส่วน</center></th>   
                        <th><center>แก้ไข</center></th> 
                       <!-- <th><center>ลบ</center></th> -->
                       
                    </tr>
                </thead>
                
                <!-- show data -->
                <?php while($row = pg_fetch_array($queryPage)){ ?>
                <tbody>
                    <tr>
                        <!-- ลำดับ 
                        <td><center><?php //echo $row['part_id']; ?></center></td>         --> 
            
                        <!-- ชื่อ -->
                        <td><center><?php echo $row['part_name']; ?></center></td>
                        
                        
                        <!-- edit -->
                        <td><center><a href="frm_herb_part_edit.php?part_id=<?php echo $row['part_id']; ?>" class="btn btn-warning btn-md">
                                <span class="glyphicon glyphicon-edit"></span>
                        </a></center></td>
                        
                        <!-- delete -->
                       <!-- <td><center><a type="button" onclick="comfirmDelete()" href="herb_part_delete.php?part_id=<?php echo $row['part_id']; ?>" class="btn btn-danger btn-md">
                                <span class="glyphicon glyphicon-remove"></span>
                        </a></center></td> -->
                    </tr>
                </tbody>
                <?php } ?>
            </table>
            
                <?php
                    $sql2 = "select * from herb_part ";
                    $query2 = pg_query($db, $sql2);
                    $total_record = pg_num_rows($query2);
                    $total_page = ceil($total_record / $perpage);
                ?>

                <nav>
                    <ul class="pagination">
                        <li class="active">
                            <a href="herb_part_manage.php?page=1" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                            <li><a href="herb_part_manage.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php } ?>
                            <li class="active">
                            <a href="herb_part_manage.php?page=<?php echo $total_page; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
        </div>
    </body>
</html>
