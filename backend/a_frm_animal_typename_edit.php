<?php 
        require 'header_admin.php';
        
        $animal_type_id = $_GET['animal_type_id'];
        
        //name
        $sql_animal_name_type = "SELECT * FROM animal_type WHERE animal_type_id='$animal_type_id'";
        $res_animal_name_type = pg_query($db, $sql_animal_name_type);
        $row_animal_name_type = pg_fetch_array($res_animal_name_type);
        
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="animalscript.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <h2>แก้ไขชื่อประเภทสัตว์</h2>
            <br>
            <form action="a_animal_typename_edit.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- type_name -->
                <div class="form-group">
                    <label for="animal_name_type" class="col-md-2 control-label">ชื่อประเภทสัตว์ :</label>
                    <div class="col-md-10">
                        <input name="animal_name_type" type="text" class="form-control" value="<?php echo $row_animal_name_type['animal_name_type']; ?>">
                    </div>
                </div>   
                
                <!-- type_details -->
                <div class="form-group">
                    <label for="animal_type_more" class="col-md-2 control-label">รายละเอียด :</label>
                    <div class="col-md-10">
                        <textarea name="animal_type_more" class="form-control" rows="10">
                            <?php echo $row_animal_type_more['animal_type_more']; ?>
                        </textarea>
                    </div>
                </div>

                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input name="treetype_id" type="hidden" value="<?php echo $row_treetypename['treetype_id']; ?>">
                        <button type="submit" class="btn btn-primary">แก้ไข</button>
                        <a href="a_animal_typename_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                
            </form>
            
        </div>
    </body>
</html>
