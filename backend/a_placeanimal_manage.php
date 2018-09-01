<?php
    require 'header_admin.php';
    require 'function.php';

?>

<?php   
 
 if (@$_GET['animal_collect_id'])  {

     @$collect_id = @$_GET['animal_collect_id'];
     @$sql = "DELETE FROM animal_collect WHERE animal_collect_id='$collect_id'";
    @$result = pg_query($db, $sql);

}



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
            <a href="a_frm_animal_add_map.php" class="btn btn-primary" >
                <span class="glyphicon glyphicon-plus"> เก็บข้อมูล</span>
            </a>
            
            <h3>ข้อมูลสำรวจสัตว์ในพื้นที่</h3> 

            <center><div id="map"></div></center>
            <br>
            <table class="table table-bordered">
                <thead>
                    <tr class="info">
                        <!--<th><center>#</center></th>-->
                        <th width="150"><center>ชื่อสัตว์</center></th>
                        <th width="250"><center>แหล่งที่พบ</center></th>
                        <th><center>รูปภาพ</center></th>
                        <th width="10"><center>ดู</center></th>
                        <th width="10"><center>ลบ</center></th>
                    </tr>
                </thead>

                <!-- show data -->
                <?php
                    //คำสั่ง sql
                    $query = "SELECT *  FROM animal_collect
                                INNER JOIN animal_data
                                ON animal_collect.animal_tumbon_id_collect = animal_data.animal_data_id
                                INNER JOIN animal_tumbon
                                ON animal_data.animal_data_id = animal_tumbon.animal_tumbon_id
                        
                                ORDER BY animal_collect_id ASC";

                    $result = pagination($query);
                    while ($row = pg_fetch_array($result)) {
                ?>

                    <tbody>
                        <tr>

                            <!-- ชื่อ -->
                            <td><center><?php echo $row['animal_name_th']; ?></center></td>

                            <!-- ชื่อสมุนไพร -->
                            <td><center><?php echo $row['animal_tumbon_name']; ?></center></td>

                            <!-- รูปภาพ -->
                            <td><center><img src="../images/<?php echo $row['collect_img']; ?>" style="width:150px;"></center></td>

                            <!-- ดูข้อมูล -->
                            <td><center><a href="a_show_animal_data.php?animal_collect_id=<?php echo $row['animal_collect_id']; ?>" class="btn btn-info btn-md">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </a></center></td>


                            <!-- delete -->
                            <td><center><a href="a_placeanimal_manage.php?animal_collect_id=<?php echo $row['animal_collect_id']; ?>" class="btn btn-danger btn-md">
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
                        <a href="a_placeanimal_manage.php?page=1" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                        <li><a href=a_placeanimal_manage.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php } ?>
                    <li class="active">
                        <a href="a_placeanimal_manage.php?page=<?php echo $total_page; ?>" aria-label="Next">
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


