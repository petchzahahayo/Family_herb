<?php 
        require 'header_expert.php';
        
        $treetype_id = $_GET['treetype_id'];
        
        //name
        $sql_treetypename = "SELECT * FROM tree_typename WHERE treetype_id='$treetype_id'";
        $res_treetypename = pg_query($db, $sql_treetypename);
        $row_treetypename = pg_fetch_array($res_treetypename);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="treescript.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <h2>แก้ไขประเภทสมุนไพร</h2>
            <br>
            <form action="tree_typename_edit.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- type_name -->
                <div class="form-group">
                    <label for="treetype_name" class="col-md-2 control-label">ประเภทสมุนไพร :</label>
                    <div class="col-md-10">
                        <input name="treetype_name" type="text" class="form-control" value="<?php echo $row_treetypename['treetype_name']; ?>">
                    </div>
                </div>   
                
                <!-- type_details -->
                <div class="form-group">
                    <label for="treetype_details" class="col-md-2 control-label">รายละเอียด :</label>
                    <div class="col-md-10">
                        <textarea name="treetype_details" class="form-control" rows="5">
                            <?php echo $row_treetypename['treetype_details']; ?>
                        </textarea>
                    </div>
                </div>

                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input name="treetype_id" type="hidden" value="<?php echo $row_treetypename['treetype_id']; ?>">
                        <button type="submit" class="btn btn-primary">แก้ไข</button>
                        <a href="tree_typename_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                
            </form>
            
        </div>
    </body>
</html>
