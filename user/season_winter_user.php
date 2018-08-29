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
                    <ul class="nav navbar-nav navbar-left">
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">
                            <button class="btn btn-secondary dropdown-toggle">
                                <span class="glyphicon glyphicon-th-list"></span> ฤดู
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="season_user.php">
                                    <span class="glyphicon glyphicon-th-list"></span> ทั้งหมด </a></li>
                                <li><a href="season_summer_user.php">
                                    <span class="glyphicon glyphicon-th-list"></span> ฤดูร้อน </a></li>
                                <li><a href="season_rainy_user.php">
                                    <span class="glyphicon glyphicon-th-list"></span> ฤดูฝน </a></li>     
                                <li><a href="season_winter_user.php">
                                    <span class="glyphicon glyphicon-th-list"></span> ฤดูหนาว </a></li>                     
                            </ul>
                        </li>
                    </ul>                  
                </div>
            </div>
            
            
            <h2>ข้อมูลการเก็บเกี่ยว</h2>
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
                        <th><center>ชื่อสมุนไพร</center>
                        </th><th><center>ฤดูร้อน</center></th>
                        </th><th><center>ฤดูฝน</center></th>
                        </th><th><center>ฤดูหนาว</center></th>
                        
                    </tr>
                </thead>
                
                <!-- show data -->
                <?php while($row = pg_fetch_array($queryPage)){ ?>
                <tbody>
                    <tr>
                        <!-- ลำดับ 
                        <td><center><?php echo $row['data_id']; ?></center></td>-->
            
                        <!-- ประเภท -->
                        <td><center><?php echo $row['type_name']; ?></center></td>
            
                        <!-- ชื่อ -->
                        <td><center><?php echo $row['name_th']; ?></center></td>
            
                        <!-- ดูข้อมูล -->
                        <td><center><a href="show_herb_data.php?data_id=<?php echo $row['data_id']; ?>" class="btn btn-info btn-md">
                                <span class="glyphicon glyphicon-eye-open"></span>
                        </a></center></td>
                        
                        <!-- edit -->
                        <td><center><a href="frm_herb_edit.php?data_id=<?php echo $row['data_id']; ?>" class="btn btn-warning btn-md">
                                <span class="glyphicon glyphicon-edit"></span>
                        </a></center></td>
                        
                        <!-- delete -->
                        <td><center><a href="herb_delete.php?data_id=<?php echo $row['data_id']; ?>" class="btn btn-danger btn-md">
                                <span class="glyphicon glyphicon-remove"></span>
                        </a></center></td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
            
                <?php
                    $sql2 = "select * from herb_data ";
                    $query2 = pg_query($db, $sql2);
                    $total_record = pg_num_rows($query2);
                    $total_page = ceil($total_record / $perpage);
                ?>

                <nav>
                    <ul class="pagination">
                        <li class="active">
                            <a href="herb_manage.php?page=1" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                            <li><a href="herb_manage.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php } ?>
                            <li class="active">
                            <a href="herb_manage.php?page=<?php echo $total_page; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
        </div>
    </body>
</html>
