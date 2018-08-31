<?php 
        require 'header_admin.php';
        
       
        
        //name
        $sql_tumbon_name = "SELECT MAX(animal_tumbon_id) FROM animal_tumbon";
        $res_tumbon_name = pg_query($db, $sql_tumbon_name);
        $row_tumbon_name = pg_fetch_row($res_tumbon_name);
        $row_tumbon_name1 = $row_tumbon_name[0];
        $row_tumbon_name2 = $row_tumbon_name1 + 1;
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
            <h2>กรอกชื่อชุมชนที่สำรวจ</h2>
            <br>
            <form action="a_animal_tumbon_insert.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- name_id -->

                <input name="treename_id" type="hidden" class="form-control" value="<?php echo $row_tumbon_name2; ?>">

                
                <!-- name_th -->
                <div class="form-group">
                    <label for="treename_th" class="col-md-2 control-label">ชื่อชุมชน :</label>
                    <div class="col-md-10">
                        <input name="treename_th" type="text" class="form-control">
                    </div>
                </div>   
                
              
                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="a_animal_tumbon_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                
            </form>
            
        </div>
    </body>
</html>
