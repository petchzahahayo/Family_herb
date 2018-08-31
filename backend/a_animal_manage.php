<?php
    require 'header_admin.php';
    require 'function.php';

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>สัตว์ตามท้องที่</title>
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
                    <a href="a_animal_tumbon_manage.php" type="button" class="btn btn-success">
                        <span class="glyphicon glyphicon-th-list"> ชุมชนสำรวจ </span>
                    </a>
                    <a href="a_animal_typename_manage.php" class="btn btn-success" >
                        <span class="glyphicon glyphicon-th-list"> ประเภทสัตว์</span>
                    </a>                    
                </div>
                
            </div>
            
            <h3>ข้อมูลสัตว์</h3> 

            <center><div id="map"></div></center>
            <br>
            <table class="table table-bordered">
                <thead>
                    <tr class="info">
                        <!--<th><center>#</center></th>-->
                        <th width="150"><center>ชื่อสัตว์</center></th>
                        <th width="250"><center>ประเภทสัตว์</center></th>
                        <th><center>รายละเอียด</center></th>
                        <th width="10"><center>ดู</center></th>
                        <th width="10"><center>แก้ไข</center></th>
                        <th width="10"><center>ลบ</center></th>
                    </tr>
                </thead>

                <!-- show data -->
                <?php
                    //คำสั่ง sql
                    $query = "SELECT animal_data.animal_name_th, animal_type.animal_name_type, animal_data.animal_detail 
from animal_data inner join animal_type 
on animal_data.animal_type_id_animal_data = animal_type.animal_type_id";

                    $result = pagination($query);
                    while ($row = pg_fetch_array($result)) {
                ?>

                    <tbody>
                        <tr>

                            <!-- ชื่อ -->
                            <td><center><?php echo $row['animal_name_th']; ?></center></td>

                            <!-- ชื่อสมุนไพร -->
                            <td width="100"><?php echo $row['animal_name_type']; ?></td>

                            <!-- รูปภาพ -->
                            <td><?php echo $row['animal_detail']; ?></td>


                            <!-- ดูข้อมูล -->
                            <td><center><a href="a_show_animal_data.php?animal_collect_id=<?php echo $row['animal_collect_id']; ?>" class="btn btn-info btn-md">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </a></center></td>

                            <!-- edit -->
                            <td><center><a href="frm_place_edit.php?place_id=<?php echo $row['place_id']; ?>" class="btn btn-warning btn-md">
                                    <span class="glyphicon glyphicon-cog"></span>
                                </a></center></td>

                            <!-- delete -->
                            <td><center><a href="a_animal_delete.php?place_id=<?php echo $row['animal_data_id']; ?>" class="btn btn-danger btn-md">
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
                        <a href="a_animal_manage.phppage=1" aria-label="Previous">
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

           
            
            <br>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>            
        </div>

    </body>
</html>


