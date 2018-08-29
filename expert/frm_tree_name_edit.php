<?php 
        require 'header_expert.php';
        
        $treename_id = $_GET['treename_id'];
        
        //name
        $sql_treename = "SELECT * FROM tree_name WHERE treename_id='$treename_id'";
        $res_treename = pg_query($db, $sql_treename);
        $row_treename = pg_fetch_array($res_treename);
        
        //alphabet
        $sql_treealphabet = "SELECT * FROM tree_alphabet";
        $res_treealphabet = pg_query($db, $sql_treealphabet);
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
            <h2>แก้ไขชื่อต้นไม้</h2>
            <br>
            <form action="tree_name_edit.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- name_th -->
                <div class="form-group">
                    <label for="treename_th" class="col-md-2 control-label">ชื่อต้นไม่้ :</label>
                    <div class="col-md-10">
                        <input name="treename_th" type="text" class="form-control" value="<?php echo $row_treename['treename_th']; ?>">
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
                                            if ($row_treealphabet[0] == $row_treename['treealphabet_id']) {
                                                echo "<option value='$row_treealphabet[0]' selected>$row_treealphabet[1]</option>"; 
                                            }
                                            echo "<option value='$row_treealphabet[0]'>$row_treealphabet[1]</option>"; 
                                        }
                                    ?>
                        </select>
                    </div>
                </div>

                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input name="treename_id" type="hidden" value="<?php echo $row_treename['treename_id']; ?>">
                        <button type="submit" class="btn btn-primary">แก้ไข</button>
                        <a href="tree_name_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                
            </form>
            
        </div>
    </body>
</html>
