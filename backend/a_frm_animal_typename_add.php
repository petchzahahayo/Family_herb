<?php
    require 'header_admin.php';

    //name ++
    $sql_animal_name_type = "SELECT MAX(animal_type_id)  FROM animal_type";
    $res_animal_name_type = pg_query($db, $sql_animal_name_type);
    $row_animal_name_type = pg_fetch_row($res_animal_name_type);
    $row_animal_name_type1 = $row_animal_name_type[0];
    $row_animal_name_type2 = $row_animal_name_type1 + 1;
   
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            <h2>กรอกชื่อประเภทสัตว์</h2>
            <br>
            <form action="a_animal_typename_insert.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- type_id -->
                <input name="animal_type_id" type="hidden" class="form-control" value="<?php echo $row_animal_name_type2; ?>">


                <!-- type_name -->
                <div class="form-group">
                    <label for="animal_name_type" class="col-md-2 control-label">ชื่อประเภทสัตว์ :</label>
                    <div class="col-md-10">
                        <input name="animal_name_type" type="text" class="form-control">
                    </div>
                </div>  
                
                <!-- type_details -->
                <div class="form-group">
                    <label for="animal_type_more" class="col-md-2 control-label">รายละเอียด :</label>
                    <div class="col-md-10">
                        <textarea name="animal_type_more" class="form-control" rows="5">
                            
                        </textarea>
                    </div>
                </div>  

                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="a_animal_typename_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
