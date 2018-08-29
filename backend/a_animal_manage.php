<?php
    require 'header_admin.php';      
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
                    <a href="a_frm_animal_add.php" class="btn btn-primary" >
                        <span class="glyphicon glyphicon-plus"> เพิ่มสัตว์</span>
                    </a>                    
                </div>
                
                <div class="col-md-6">
                    <a href="a_animal_name_manage.php" type="button" class="btn btn-success">
                        <span class="glyphicon glyphicon-th-list"> รายชื่อสัตว์ </span>
                    </a>
                    <a href="a_animal_typename_manage.php" class="btn btn-success" >
                        <span class="glyphicon glyphicon-th-list"> รายชื่อประเภทสัตว์</span>
                    </a>                    
                </div>
                
            </div>
            
            <h2>ข้อมูลสัตว์</h2> 
            <table class="table table-bordered">
                <thead>
                    
                    <!-- แบ่งหน้า -->
                    <?php 
                        //กำหนดจำนวนหน้า
                        $treeperpage = 20;
                        
                        //เช็คว่าเป็นค่าว่างหรือไม่
                        if (isset($_GET['pagetree'])) {
                            $treepage = $_GET['pagetree'];
                        } else {
                            $treepage = 1;
                        }

                        $treestart = ($treepage - 1) * $treeperpage;

                        $sqlPagetree = "SELECT * FROM tree_name
                                    INNER JOIN tree_data
                                    ON tree_name.treename_id = tree_data.treename_id
                                    INNER JOIN tree_typename
                                    ON tree_data.treetype_id = tree_typename.treetype_id
                                    ORDER BY treedata_id ASC limit {$treeperpage} offset {$treestart}
                                   ";
                        $queryPagetree = pg_query($db, $sqlPagetree);
                    ?>
                    
                    <tr class="info">
                        <!--<th><center>#</center></th>-->
                        <th><center>ประเภท</center></th>
                        <th><center>ชื่อ</center></th>
                        <th><center>ดูข้อมูล</center></th>
                        <th><center>แก้ไข</center></th>
                        <th><center>ลบ</center></th>
                    </tr>
                </thead>
                
                <!-- show data -->
                <?php while($row = pg_fetch_array($queryPagetree)){ ?>
                <tbody>
                    <tr>
                        <!-- ลำดับ 
                        <td><center><?php echo $row['treedata_id']; ?></center></td>-->
            
                        <!-- ประเภท -->
                        <td><center><?php echo $row['treetype_name']; ?></center></td>
            
                        <!-- ชื่อ -->
                        <td><center><?php echo $row['treename_th']; ?></center></td>
            
                        <!-- ดูข้อมูล -->
                        <td><center><a href="a_show_animal_data.php?animaldata_id=<?php echo $row['treedata_id']; ?>" class="btn btn-info btn-md">
                                <span class="glyphicon glyphicon-eye-open"></span>
                        </a></center></td>
                        
                        <!-- edit -->
                        <td><center><a href="a_frm_animal_edit.php?treedata_id=<?php echo $row['treedata_id']; ?>" class="btn btn-warning btn-md">
                                <span class="glyphicon glyphicon-edit"></span>
                        </a></center></td>
                        
                        <!-- delete -->
                        <td><center><a href="a_animal_delete.php?animaldata_id=<?php echo $row['treedata_id']; ?>" class="btn btn-danger btn-md">
                                <span class="glyphicon glyphicon-remove"></span>
                        </a></center></td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
            
                <?php
                    $sql2 = "select * from tree_data ";
                    $query2 = pg_query($db, $sql2);
                    $total_record = pg_num_rows($query2);
                    $total_page = ceil($total_record / $treeperpage);
                ?>

                <nav>
                    <ul class="pagination">
                        <li class="active">
                            <a href="a_animal_manage.php?page=1" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                            <li><a href="a_animal_manage.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php } ?>
                            <li class="active">
                            <a href="a_animal_manage.php?page=<?php echo $total_page; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
        </div>
    </body>
</html>
