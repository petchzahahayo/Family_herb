<?php 
        require 'header_admin.php';
        
        //alphabet
        $sql_treealphabet = "SELECT * FROM tree_alphabet";
        $res_treealphabet = pg_query($db, $sql_treealphabet);
        
        //name
        $sql_treename = "SELECT MAX(treename_id) FROM tree_name";
        $res_treename = pg_query($db, $sql_treename);
        $row_treename = pg_fetch_row($res_treename);
        $row_treename1 = $row_treename[0];
        $row_treename2 = $row_treename1 + 1;
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
            <h2>กรอกชื่อสัตว์</h2>
            <br>
            <form action="a_animal_name_insert.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- name_id -->

                <input name="treename_id" type="hidden" class="form-control" value="<?php echo $row_treename2; ?>">

                
                <!-- name_th -->
                <div class="form-group">
                    <label for="treename_th" class="col-md-2 control-label">ชื่อสัตว์ :</label>
                    <div class="col-md-10">
                        <input name="treename_th" type="text" class="form-control">
                    </div>
                </div>   
                
                <!-- alphabet -->
                <div class="form-group">
                    <label for="treealphabet_id" class="col-md-2 control-label">หมวดตัวอักษร :</label>
                    <div class="col-md-10">
                        <select name="treealphabet_id" id="treealphabet_id" class="form-control">
                                    <!-- ดึงข้อมูลจากฐานข้อมูล -->
                                    <?php
                                        while($row_treealphabet = pg_fetch_row($res_treealphabet))
                                        {
                                            echo "<option value='$row_treealphabet[0]'>$row_treealphabet[1]</option>"; 
                                        }
                                    ?>
                        </select>
                    </div>
                </div>

                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="a_animal_name_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                
            </form>
            
        </div>
    </body>
</html>
