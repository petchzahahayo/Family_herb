<?php
    require 'header_admin.php';      
?>
<?php   
 
 if (@$_GET['animal_tumbon_id'])  {

     @$tumbon_id = @$_GET['animal_tumbon_id'];
     $sql = "DELETE FROM animal_tumbon WHERE animal_tumbon_id='$tumbon_id'";
    $result = pg_query($db, $sql);

}



  ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <a href="a_frm_animal_tumbon_add.php" class="btn btn-primary" >
                        <span class="glyphicon glyphicon-plus"> เพิ่มชื่อมูลชุมชน</span>
                    </a>
                </div>
                
                <div class="col-md-6">
                    <a href="a_animal_manage.php" type="button" class="btn btn-success">
                        <span class="glyphicon glyphicon-th-list"> ข้อมูลสัตว์</span>
                    </a>
                    <a href="a_animal_typename_manage.php" type="button" class="btn btn-success">
                        <span class="glyphicon glyphicon-th-list"> ประเภทสัตว์</span>
                    </a>
                </div>
                
            </div>
            
            <h2>รายชื่อชุมชนที่ลงสำรวจ</h2> 
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

                        $sqlPage = "SELECT * FROM animal_tumbon
                                    ORDER BY animal_tumbon_id ASC limit {$perpage} offset {$start}
                                   ";
                        $queryPage = pg_query($db, $sqlPage);
                    ?>
                    
                    <tr class="info">
                        <!--<th><center>#</center></th>    -->                    
                        <th><center>ชื่อชุมชน</center></th>                        
                        <th><center>แก้ไข</center></th>
                        <th><center>ลบ</center></th>
                    </tr>
                </thead>
                
                <!-- show data -->
                <?php while($row = pg_fetch_array($queryPage)){ ?>
                <tbody>
                    <tr>
                        <!-- ลำดับ 
                        <td><center><?php //echo $row['name_id']; ?></center></td>     -->     
            
                        <!-- ชื่อ -->
                        <td height="15"><center><?php echo $row['animal_tumbon_name']; ?></center></td>
                        
                        <!-- edit -->
                        <td width="10"><center><a href="a_frm_animal_tumbon_edit.php?animal_tumbon_id=<?php echo $row['animal_tumbon_id']; ?>" class="btn btn-warning btn-md">
                                <span class="glyphicon glyphicon-cog"></span>
                        </a></center></td>
                        
                        <!-- delete -->
                        <td width="10"><center><a href="a_animal_tumbon_manage.php?animal_tumbon_id=<?php echo $row['animal_tumbon_id']; ?>" class="btn btn-danger btn-md">
                                <span class="glyphicon glyphicon-remove"></span>
                        </a></center></td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
            
                <?php
                    $sql22 = "select * from animal_tumbon ";
                    $query22 = pg_query($db, $sql22);
                    $total_record = pg_num_rows($query22);
                    $total_page = ceil($total_record / $perpage);
                ?>

                <nav>
                    <ul class="pagination">
                        <li class="active">
                            <a href="a_animal_name_manage.php?page=1" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                            <li><a href="a_animal_tumbon_manage.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php } ?>
                            <li class="active">
                            <a href="a_animal_tumbon_manage.php?page=<?php echo $total_page; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
        </div>
    </body>
</html>
