<?php 
        require 'header_admin.php';
        
        //ประเภทสัตว์
        $sqlanimaltype = "SELECT * FROM animal_type";
        $queryanimaltype = pg_query($db, $sqlanimaltype);
        
        //name++
        $sql_treedata = "SELECT MAX(animal_data_id) FROM animal_data";
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
            <h2>กรอกข้อมูลสัตว์</h2>
            <br>
            <form action="a_animal_insert.php" method="GET" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- data_id 
                <div class="form-group">
                    <label for="data_id" class="col-md-2 control-label">ลำดับ :</label>
                    <div class="col-md-10">-->
                        <input name="animal_data_id" type="hidden" class="form-control" value="<?php echo $row_treedata2; ?>">
                    <!--</div>
                </div>-->
                
                <!-- herb_type -->
                <div class="form-group">
                    <label for="animal_type_id_animal_data" class="col-md-2 control-label">ประเภทสัตว์ :</label>
                    <div class="col-md-10">
                        <select name="animal_type_id_animal_data" id="owner_id" class="form-control">
                                    <!-- ดึงข้อมูลจากฐานข้อมูล -->
                                    <?php
                                        while($rowanimaltype = pg_fetch_row($queryanimaltype))
                                        {
                                            echo "<option value='$rowanimaltype[0]'>$rowanimaltype[1]</option>"; 
                                        }
                                    ?>
                        </select>
                    </div>
                </div>


                <!-- data_name_eng -->
                <div class="form-group">
                    <label for="animal_name_th" class="col-md-2 control-label">ชื่อภาษาไทย:</label>
                    <div class="col-md-10">
                        <input name="animal_name_th" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="animal_name_eng" class="col-md-2 control-label">ชื่อภาษาอังกฤษ :</label>
                    <div class="col-md-10">
                        <input name="animal_name_eng" type="text" class="form-control">
                    </div>
                </div>
                
                <!-- data_name_sci -->
                <div class="form-group">
                    <label for="animal_name_science" class="col-md-2 control-label">ชื่อวิทยาศาสตร์ :</label>
                    <div class="col-md-10">
                        <input name="animal_name_science" type="text" class="form-control">
                    </div>
                </div>
                
                 <!-- data_hight -->
                 <div class="form-group">
                    <label for="animal_high" class="col-md-2 control-label">ความสูงของสัตว์ :</label>
                    <div class="col-md-10">
                        <input name="animal_high" placeholder="เซนติเมตร" type="number" class="form-control">
                    </div>
                </div>

                 <!-- data_width -->
                 <div class="form-group">
                    <label for="animal_long" class="col-md-2 control-label">ความกว้างของสัตว์ :</label>
                    <div class="col-md-10">
                        <input name="animal_long" placeholder="เซนติเมตร" type="number" class="form-control">
                    </div>
                </div>


                 <!-- data_detail -->
                 <div class="form-group">
                    <label for="animal_detail" class="col-md-2 control-label">ลักษณะสังเกต :</label>
                    <div class="col-md-10">
                        <textarea name="animal_detail" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                
                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="a_animal_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                <br><br>
                
            </form>
            
        </div>
    </body>
</html>
