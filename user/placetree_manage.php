<?php
    require 'header_user.php';
    require 'treefunction.php';

    //คำสั่ง sql เรียกเฉพาะข้อมูล = 9999
        $sql2 = "SELECT *  FROM tree_place 
                 INNER JOIN tree_owner  
                 ON tree_place.treeowner_id = tree_owner.treeowner_id 
                 INNER JOIN tree_name  
                 ON tree_place.treename_id = tree_name.treename_id
                 WHERE treename_th = 'ก9999' ";
        $result2 = pg_query($db, $sql2);    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ระบบเก็บข้อมูลสมุนไพร</title>
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
            <a href="frm_placetree_add.php" class="btn btn-primary" >
                <span class="glyphicon glyphicon-plus"> เพิ่มต้นไม้</span>
            </a>

            <h2>ข้อมูลต้นไม้</h2> 

            <center><div id="map"></div></center>
            <br>
            <table class="table table-bordered">
                <thead>
                    <tr class="info">
                        <!--<th><center>#</center></th>-->
                        <th><center>ชื่อ</center></th>
                        <th><center>ชื่อต้นไม้</center></th>
                        <th><center>รูปภาพ</center></th>
                        <th><center>ดูข้อมูล</center></th>
                        <th><center>แก้ไข</center></th>
                        <th><center>ลบ</center></th>
                    </tr>
                </thead>

                <!-- show data -->
                <?php
                    //คำสั่ง sql
                    $query = "SELECT *  FROM tree_place 
                                INNER JOIN tree_owner
                                ON tree_place.treeowner_id = tree_owner.treeowner_id
                                INNER JOIN tree_name
                                on tree_place.treename_id = tree_name.treename_id
                                WHERE treename_th NOT IN ('ก9999')
                                ORDER BY treeplace_id ASC";

                    $result = pagination($query);
                    while ($row = pg_fetch_array($result)) {
                ?>

                    <tbody>
                        <tr>

                            <!-- ชื่อ -->
                            <td><center><?php echo $row['treeowner_name']; ?></center></td>

                            <!-- ชื่อสมุนไพร -->
                            <td><center><?php echo $row['treename_th']; ?></center></td>

                            <!-- รูปภาพ -->
                            <td><center><img src="../images/<?php echo $row['treeplace_herbimg']; ?>" style="width:100px;height:100px;"></center></td>

                            <!-- ดูข้อมูล -->
                            <td><center><a href="show_place_data.php?treeplace_id=<?php echo $row['treeplace_id']; ?>" class="btn btn-info btn-md">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </a></center></td>

                            <!-- edit -->
                            <td><center><a href="frm_place_edit.php?treeplace_id=<?php echo $row['treeplace_id']; ?>" class="btn btn-warning btn-md">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a></center></td>

                            <!-- delete -->
                            <td><center><a href="place_delete.php?treeplace_id=<?php echo $row['treeplace_id']; ?>" class="btn btn-danger btn-md">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a></center></td>

                    </tr>
                    </tbody>
                <?php } ?> 
            </table>
            
            <!-- paginationBar -->
            <?php
                $total_page = paginationBar($query);
            ?>

            <nav>
                <ul class="pagination">
                    <li class="active">
                        <a href="place_manage.php?page=1" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                        <li><a href="place_manage.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php } ?>
                    <li class="active">
                        <a href="place_manage.php?page=<?php echo $total_page; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- paginationBar -->
            <h2>ข้อมูลสต้นไม้ที่ไม่ปรากฎชื่อ</h2> 
            <table class="table table-bordered">
                <tr class="danger">
                    <!--<th><center>#</center></th>-->
                    <th><center>ชื่อ</center></th>
                    <th><center>ชื่อต้นไม้</center></th>
                    <th><center>รูปภาพ</center></th>
                    <th><center>ดูข้อมูล</center></th>
                    <th><center>แก้ไข</center></th>
                    <th><center>ลบ</center></th>
                </tr>

                <?php while ($row2 = pg_fetch_array($result2)) { ?>

                    <tr>
                        <!--<td><center><?php //echo $row2['place_id']; ?></center></td>-->
                        <td><center><?php echo $row2['treeowner_name']; ?></center></td>
                        <td><center><?php echo $row2['treename_th']; ?></center></td>
                        <td><center><img src="../images/<?php echo $row2['treeplace_herbimg']; ?>" style="width:100px;height:100px;"></center></td>
                        <!-- ดูข้อมูล -->
                        <td><center><a href="show_place_data.php?treeplace_id=<?php echo $row2['treeplace_id']; ?>" class="btn btn-info btn-md">
                                <span class="glyphicon glyphicon-eye-open"></span>
                            </a></center></td>
                        <!-- edit -->
                        <td><center><a href="frm_place_edit.php?treeplace_id=<?php echo $row2['treeplace_id']; ?>" class="btn btn-warning btn-md">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a></center></td>

                        <!-- delete -->
                        <td><center><a href="place_delete.php?treeplace_id=<?php echo $row2['treeplace_id']; ?>" class="btn btn-danger btn-md">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a></center></td>
                    </tr>
                <?php } ?>
            </table>

            <br>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>            
        </div>

    </body>
</html>


