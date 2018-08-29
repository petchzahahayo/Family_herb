<?php
        require 'header_expert.php';
        
        //รับค่า
        $treedata_id = $_GET['treedata_id'];
        
        //คำสั่ง sql
        $sql = "SELECT * FROM tree_data WHERE treedata_id='$treedata_id'";
        $result = pg_query($db, $sql);
        $row = pg_fetch_array($result);
        
        //herb_data
        $sqltreeData = "SELECT * FROM tree_name";
        $restreeData = pg_query($db, $sqltreeData);
        
        //sql herb_type
        $sqltreeType = "SELECT * FROM tree_typename";
        $querytreeType = pg_query($db, $sqltreeType);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            <h2>แก้ไขข้อมูลต้นไม้</h2>
            <br>
            <form action="tree_edit.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- herb_type -->
                <div class="form-group">
                    <label for="treetype_id" class="col-md-2 control-label">ประเภทสมุนไพร :</label>
                    <div class="col-md-10">
                        <select name="treetype_id" id="owner_id" class="form-control">
                            
                            <!-- ดึงข้อมูลจากฐานข้อมูล -->
                            <?php
                            while ($rowtreeType = pg_fetch_row($querytreeType)) {
                                if ($rowtreeType[0] == $row['treetype_id']) {
                                    echo "<option value='$rowtreeType[0]' selected>$rowtreeType[1]</option>";
                                } else {
                                    echo "<option value='$rowtreeType[0]'>$rowtreeType[1]</option>";
                                }
                            }
                            ?>
                                    
                        </select>
                    </div>
                </div>
                
                <!-- name_th -->
                <div class="form-group">
                    <label for="treename_id" class="col-md-2 control-label">ชื่อสมุนไพร :</label>
                    <div class="col-md-10">
                        <select name="treename_id" class="form-control">     
                        
                            <!-- ดึงข้อมูลจากฐานข้อมูล -->
                            <?php
                            while ($rowtreeData = pg_fetch_row($restreeData)) {
                                if ($rowtreeData[0] == $row['treename_id']) {
                                    echo "<option value='$rowtreeData[0]' selected>$rowtreeData[1]</option>";
                                } else {
                                    echo "<option value='$rowtreeData[0]'>$rowtreeData[1]</option>";
                                }
                            }
                            ?>

                        </select>
                    </div>
                </div>
                
                <!-- name_eng -->
                <div class="form-group">
                    <label class="col-md-2 control-label">ชื่อภาษาอังกฤษ :</label>
                    <div class="col-md-10">
                        <input name="treedata_name_eng" type="text" class="form-control" value="<?php echo $row['treedata_name_eng']; ?>">
                    </div>
                </div>
                
                <!-- name_sci -->
                <div class="form-group">
                    <label class="col-md-2 control-label">ชื่อวิทยาศาสตร์ :</label>
                    <div class="col-md-10">
                        <input name="treedata_name_sci" type="text" class="form-control" value="<?php echo $row['treedata_name_sci']; ?>">
                    </div>
                </div>
                
                      

                <!-- treedata_hight -->
                <div class="form-group">
                    <label class="col-md-2 control-label">ความสูงของต้นไม้ :</label>
                    <div class="col-md-10">
                        <input name="treedata_hight" type="text" class="form-control" value="<?php echo $row['treedata_hight']; ?>">
                    </div>
                </div>            

                <!-- treedata_wideth -->
                <div class="form-group">
                    <label class="col-md-2 control-label">ความกว้างของต้นไม้ :</label>
                    <div class="col-md-10">
                        <input name="treedata_wideth" type="text" class="form-control" value="<?php echo $row['treedata_wideth']; ?>">
                    </div>
                </div>

                <!-- treedata_radius -->
                <div class="form-group">
                    <label class="col-md-2 control-label">เส้นรอบวงของต้นไม้ :</label>
                    <div class="col-md-10">
                        <input name="treedata_radius" type="text" class="form-control" value="<?php echo $row['treedata_radius']; ?>">
                    </div>
                </div>

                <!-- data_detail -->
                <div class="form-group">
                    <label class="col-md-2 control-label">ลักษณะของต้นไม้ :</label>
                    <div class="col-md-10">
                        <textarea name="treedata_detail" class="form-control" rows="5">
                            <?php echo $row['treedata_detail']; ?>
                        </textarea>
                    </div>
                </div>
                  
                
                
                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="hidden" name="treedata_id" value="<?php echo $row['treedata_id'] ?>">
                        <button type="submit" class="btn btn-primary">แก้ไข</button>
                        <a href="tree_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                
            </form>
        </div>
    </body>
</html>
