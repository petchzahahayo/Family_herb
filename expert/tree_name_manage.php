<?php
    require 'header_expert.php';      
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
                    
                </div>
                
                <div class="col-md-6">
                    <a href="tree_manage.php" type="button" class="btn btn-success">
                        <span class="glyphicon glyphicon-th-list"> ข้อมูลต้นไม้</span>
                    </a>
                    <a href="tree_typename_manage.php" type="button" class="btn btn-success">
                        <span class="glyphicon glyphicon-th-list"> ประเภทต้นไม้</span>
                    </a>
                </div>
                
            </div>
            
            <h2>รายชื่อต้นไม้</h2> 
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

                        $sqlPage = "SELECT * FROM tree_name
                                    ORDER BY treename_id ASC limit {$perpage} offset {$start}
                                   ";
                        $queryPage = pg_query($db, $sqlPage);
                    ?>
                    
                    <tr class="info">
                        <!--<th><center>#</center></th>    -->                    
                        <th><center>ชื่อ</center></th>                        
                        <th><center>แก้ไข</center></th>
                        <!--<th><center>ลบ</center></th>-->
                    </tr>
                </thead>
                
                <!-- show data -->
                <?php while($row = pg_fetch_array($queryPage)){ ?>
                <tbody>
                    <tr>
                        <!-- ลำดับ 
                        <td><center><?php //echo $row['name_id']; ?></center></td>     -->     
            
                        <!-- ชื่อ -->
                        <td><center><?php echo $row['treename_th']; ?></center></td>
                        
                        <!-- edit -->
                        <td><center><a href="frm_tree_name_edit.php?treename_id=<?php echo $row['treename_id']; ?>" class="btn btn-warning btn-md">
                                <span class="glyphicon glyphicon-edit"></span>
                        </a></center></td>
                        
                        <!-- delete 
                        <td><center><a href="tree_name_delete.php?treename_id=<?php echo $row['treename_id']; ?>" class="btn btn-danger btn-md">
                                <span class="glyphicon glyphicon-remove"></span>
                        </a></center></td>-->
                    </tr>
                </tbody>
                <?php } ?>
            </table>
            
                <?php
                    $sql22 = "select * from tree_name ";
                    $query22 = pg_query($db, $sql22);
                    $total_record = pg_num_rows($query22);
                    $total_page = ceil($total_record / $perpage);
                ?>

                <nav>
                    <ul class="pagination">
                        <li class="active">
                            <a href="tree_name_manage.php?page=1" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                            <li><a href="tree_name_manage.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php } ?>
                            <li class="active">
                            <a href="tree_name_manage.php?page=<?php echo $total_page; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
        </div>
    </body>
</html>
