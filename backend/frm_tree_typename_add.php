<?php
    require 'header_admin.php';

    //name
    $sql_treetypename = "SELECT  FROM tree_typename";
    $res_treetypename = pg_query($db, $sql_treetypename);
    $row_treetypename = pg_fetch_row($res_treetypename);
   
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            <h2>กรอกชื่อประเภทต้นไม้</h2>
            <br>
            <form action="herb_typename_insert.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- type_id -->
                <input name="type_id" type="hidden" class="form-control" value="<?php echo $row_typename2; ?>">


                <!-- type_name -->
                <div class="form-group">
                    <label for="type_name" class="col-md-2 control-label">ชื่อประเภทต้นไม้ :</label>
                    <div class="col-md-10">
                        <input name="type_name" type="text" class="form-control">
                    </div>
                </div>  
                
                <!-- type_details -->
                <div class="form-group">
                    <label for="type_details" class="col-md-2 control-label">รายละเอียด :</label>
                    <div class="col-md-10">
                        <textarea name="type_details" class="form-control" rows="5">
                            
                        </textarea>
                    </div>
                </div>  

                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="herb_typename_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
