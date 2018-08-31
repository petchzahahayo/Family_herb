<?php
    require 'header_admin.php';

    //name
    $sql_treetypename = "SELECT MAX(leaf_id)  FROM leaf";
    $res_treetypename = pg_query($db, $sql_treetypename);
    $row_treetypename = pg_fetch_row($res_treetypename);
    $row_treetypename1 = $row_treetypename[0];
    $row_treetypename2 = $row_treetypename1 + 1;
   
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
            <form action="tree_leaf_insert.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- type_id -->
                <input name="leaf_id" type="hidden" class="form-control" value="<?php echo $row_treetypename2; ?>">


                <!-- type_name -->
                <div class="form-group">
                    <label for="leaf_name" class="col-md-2 control-label">ชื่อประเภทต้นไม้ :</label>
                    <div class="col-md-10">
                        <input name="leaf_name" type="text" class="form-control">
                    </div>
                </div>  
                 

                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="tree_leaf_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
