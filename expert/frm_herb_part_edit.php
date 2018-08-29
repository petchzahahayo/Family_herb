<?php 
        require 'header_expert.php';
        
        $part_id = $_GET['part_id'];
        
        //name
        $sql_partname = "SELECT * FROM herb_part WHERE part_id ='$part_id'";
        $res_partname = pg_query($db, $sql_partname);
        $row_partname = pg_fetch_array($res_partname);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="script.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <h2>แก้ไขส่วนของสมุนไพร</h2>
            <br>
            <form action="herb_part_edit.php" method="POST" encpart="multipart/form-data" class="form-horizontal">
                
                <!-- part_name -->
                <div class="form-group">
                    <label for="part_name" class="col-md-2 control-label">ส่วน :</label>
                    <div class="col-md-10">
                        <input name="part_name" type="text" class="form-control" value="<?php echo $row_partname['part_name']; ?>">
                    </div>
                </div>   
                
               
                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input name="part_id" type="hidden" value="<?php echo $row_partname['part_id']; ?>">
                        <button type="submit" class="btn btn-primary">แก้ไข</button>
                        <a href="herb_part_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                
            </form>
            
        </div>
    </body>
</html>
