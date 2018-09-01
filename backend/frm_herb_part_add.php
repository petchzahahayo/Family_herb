<?php
    require 'header_admin.php';

    //name
    $sql_partname = "SELECT MAX(part_id) FROM herb_part";
    $res_partname = pg_query($db, $sql_partname);
    $row_partname = pg_fetch_row($res_partname);
    $row_partname1 = $row_partname[0];
    $row_partname2 = $row_partname1 + 1;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            <h2>กรอกส่วนของสมุนไพร</h2>
            <br>
            <form action="herb_part_insert.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- part_id -->
                <input name="part_id" type="hidden" class="form-control" value="<?php echo $row_partname2; ?>">


                <!-- part_name -->
                <div class="form-group">
                    <label for="part_name" class="col-md-2 control-label">ส่วนของสมุนไพร :</label>
                    <div class="col-md-10">
                        <input name="part_name" type="text" class="form-control">
                    </div>
                </div>  
                
               

                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="herb_part_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
