<?php
    require 'header_user.php';      
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script>
            var url = window.location; 
            // Will only work if string in href matches with location  

           $('ul.nav a[href="'+ url +'"]').parent().addClass('active');    
           // Will also work for relative and absolute hrefs  

           $('ul.nav a').filter(function() { 
                return this.href == url;
           }).parent().addClass('active');
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <a href="frm_medic_add.php" class="btn btn-primary" >
                        <span class="glyphicon glyphicon-plus"> เพิ่มยา</span>
                    </a>                    
                </div>
                
                <!-- <div class="col-md-6">
                    <a href="herb_part_manage.php" type="button" class="btn btn-success">
                        <span class="glyphicon glyphicon-th-list"> รายชื่อส่วนที่ใช้ </span>
                    </a>
                    <a href="medic_type_manage.php" class="btn btn-success" >
                        <span class="glyphicon glyphicon-th-list"> รายชื่อประเภทยา</span>
                    </a>                    
                </div> -->
                
            </div>
            
            <h2>ข้อมูลยา</h2> 
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

                        $sqlPage = "SELECT * FROM herb_name
                                    INNER JOIN medicine
                                    ON herb_name.name_id = medicine.name_id
                                    INNER JOIN medicine_type
                                    ON medicine.type_id = medicine_type.type_id  
                                    ORDER BY medicine_id ASC limit {$perpage} offset {$start}
                                   ";
                        $queryPage = pg_query($db, $sqlPage);
                    ?>
                    
                    <tr class="info">
                        <!--<th><center>#</center></th>-->
                        <th><center>ประเภท</center></th>
                        <th><center>ชื่อสมุนไพร</center></th>
                        <th><center>ชื่อยา</center></th>
                        <th><center>รูปภาพ</center></th>
                        <th><center>ดูข้อมูล</center></th>
                        <th><center>แก้ไข</center></th>
                        <th><center>ลบ</center></th>
                    </tr>
                </thead>
                
                <!-- show data -->
                <?php while($row = pg_fetch_array($queryPage)){ ?>
                <tbody>
                    <tr>
                        <!-- ลำดับ 
                        <td><center><?php echo $row['medicine_id']; ?></center></td>-->
            
                        <!-- ประเภท -->
                        <td><center><?php echo $row['type_name']; ?></center></td>
            
                        <!-- ชื่อ -->
                        <td><center><?php echo $row['name_th']; ?></center></td>

                        <!-- ชื่อยา -->
                        <td><center><?php echo $row['medicine_name']; ?></center></td>

                        <!-- img -->
                        <td><center><img src="../images/<?php echo $row['medicine_img']; ?>" style="width:100px;height:100px;"></center></td>
            
                        <!-- ดูข้อมูล -->
                        <td><center><a href="show_medicine.php?medicine_id=<?php echo $row['medicine_id']; ?>" class="btn btn-info btn-md">
                                <span class="glyphicon glyphicon-eye-open"></span>
                        </a></center></td>
                        
                        <!-- edit -->
                        <td><center><a href="frm_medic_edit.php?medicine_id=<?php echo $row['medicine_id']; ?>" class="btn btn-warning btn-md">
                                <span class="glyphicon glyphicon-edit"></span>
                        </a></center></td>
                        
                        <!-- delete -->
                        <td><center><a href="medic_delete.php?medicine_id=<?php echo $row['medicine_id']; ?>" class="btn btn-danger btn-md">
                                <span class="glyphicon glyphicon-remove"></span>
                        </a></center></td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
            
                <?php
                    $sql2 = "select * from medicine ";
                    $query2 = pg_query($db, $sql2);
                    $total_record = pg_num_rows($query2);
                    $total_page = ceil($total_record / $perpage);
                ?>

                <nav>
                    <ul class="pagination">
                        <li class="active">
                            <a href="medic_manage.php?page=1" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                            <li><a href="medic_manage.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php } ?>
                            <li class="active">
                            <a href="medic_manage.php?page=<?php echo $total_page; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                   
        </div>
    </body>

    
</html>
