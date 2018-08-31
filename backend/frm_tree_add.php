<?php 
        require 'header_admin.php';
        
        //sql herb_type
        $sqltreeType = "SELECT * FROM tree_typename";
        $querytreeType = pg_query($db, $sqltreeType);
        
        //sql herb_name
        $sql_treename = "SELECT * FROM tree_name";
        $res_treename = pg_query($db, $sql_treename);

        $sql_leaf = "SELECT * FROM leaf";
        $res_leaf = pg_query($db, $sql_leaf);
        
        //herb_data
        $sql_treedata = "SELECT MAX(treedata_id) FROM tree_data";
        $res_treedata = pg_query($db, $sql_treedata);
        $row_treedata = pg_fetch_row($res_treedata);
        $row_treedata1 = $row_treedata[0];
        $row_treedata2 = $row_treedata1 + 1;
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
            <h2>กรอกข้อมูลต้นไม้</h2>
            <br>
            <form action="tree_insert.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- data_id 
                <div class="form-group">
                    <label for="data_id" class="col-md-2 control-label">ลำดับ :</label>
                    <div class="col-md-10">-->
                        <input name="treedata_id" type="hidden" class="form-control" value="<?php echo $row_treedata2; ?>">
                    <!--</div>
                </div>-->
                
                <!-- herb_type -->
                <div class="form-group">
                    <label for="treetype_id" class="col-md-2 control-label">ประเภทต้นไม้ :</label>
                    <div class="col-md-10">
                        <select name="treetype_id" id="owner_id" class="form-control">
                                    <!-- ดึงข้อมูลจากฐานข้อมูล -->
                                    <?php
                                        while($rowtreeType = pg_fetch_row($querytreeType))
                                        {
                                            echo "<option value='$rowtreeType[0]'>$rowtreeType[1]</option>"; 
                                        }
                                    ?>
                        </select>
                    </div>
                </div>
                
                <!-- alphabet -->
                <div class="form-group">
                    <label for="treealphabet" class="col-md-2 control-label">ชื่อสมุนไพร :</label>
                    <div class="col-md-10">
                            <select name="treealphabet" id="treealphabet" class="form-control">
                                <option value="">--เลือกตัวอักษร--</option>
                                
                                    <!-- ดึงข้อมูลจากฐานข้อมูล -->
                                    <?php
                                      $sql_treealphabet = "SELECT * FROM tree_alphabet";
                                      $res_treealphabet = pg_query($db, $sql_treealphabet);
                                    
                                        while($row_treealphabet = pg_fetch_array($res_treealphabet))
                                        {
                                            $treealphabet_id = $row_treealphabet['treealphabet_id'];
                                            $treealphabet_th = $row_treealphabet['treealphabet_th'];
                                            echo "<option value='$treealphabet_id'>$treealphabet_th</option>";
                                        }
                                    ?>
                                
                            </select>
                    </div>
                </div>

                <!-- data_name_eng -->
                <div class="form-group">
                    <label for="treedata_name_eng" class="col-md-2 control-label">ชื่อภาษาอังกฤษ :</label>
                    <div class="col-md-10">
                        <input name="treedata_name_eng" type="text" class="form-control">
                    </div>
                </div>
                
                <!-- data_name_sci -->
                <div class="form-group">
                    <label for="treedata_name_sci" class="col-md-2 control-label">ชื่อวิทยาศาสตร์ :</label>
                    <div class="col-md-10">
                        <input name="treedata_name_sci" type="text" class="form-control">
                    </div>
                </div>
                
                 <!-- data_hight -->
                 <div class="form-group">
                    <label for="treedata_hight" class="col-md-2 control-label">ความสูงของต้นไม้ :</label>
                    <div class="col-md-10">
                        <input name="treedata_hight" placeholder="เซนติเมตร" type="number" class="form-control">
                    </div>
                </div>

                 <!-- data_width -->
                 <div class="form-group">
                    <label for="treedata_wideth" class="col-md-2 control-label">ความกว้างของต้นไม้ :</label>
                    <div class="col-md-10">
                        <input name="treedata_wideth" placeholder="เซนติเมตร" type="number" class="form-control">
                    </div>
                </div>

                <!-- data_radus -->
                <div class="form-group">
                    <label for="treedata_radius" class="col-md-2 control-label">เส้นรอบวงของต้นไม้ :</label>
                    <div class="col-md-10">
                        <input name="treedata_radius" placeholder="เซนติเมตร" type="number" class="form-control">
                    </div>
                </div>

                 <!-- data_detail -->
                 <div class="form-group">
                    <label for="treedata_detail" class="col-md-2 control-label">ลักษณะของต้นไม้ :</label>
                    <div class="col-md-10">
                        <textarea name="treedata_detail" class="form-control" rows="5"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="laaf_id" class="col-md-2 control-label">ประเภทต้นไม้ :</label>
                    <div class="col-md-10">
                        <select name="leaf_id" id="owner_id" class="form-control">
                                    <!-- ดึงข้อมูลจากฐานข้อมูล -->
                                    <?php
                                        while($rowleaf = pg_fetch_row($res_leaf))
                                        {
                                            echo "<option value='$rowleaf[0]'>$rowleaf[1]</option>"; 
                                        }
                                    ?>
                        </select>
                    </div>
                </div>
                
                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="tree_name_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                <br><br>
                
            </form>
            
        </div>
    </body>
</html>
