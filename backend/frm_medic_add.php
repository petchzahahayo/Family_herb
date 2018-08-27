<?php 
        require 'header_admin.php';

        //sql medic_part
        $sqlPart = "SELECT * FROM herb_part";
        $queryPart = pg_query($db, $sqlPart);
        
        //sql medic_type
        $sqlType = "SELECT * FROM medicine_type";
        $queryType = pg_query($db, $sqlType);
        
        //sql herb_name
        $sql_name = "SELECT * FROM herb_name";
        $res_name = pg_query($db, $sql_name);
        
        //medicine
        $sql_data = "SELECT MAX(medicine_id) FROM medicine";
        $res_data = pg_query($db, $sql_data);
        $row_data = pg_fetch_row($res_data);
        $row_data1 = $row_data[0];
        $row_data2 = $row_data1 + 1;
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
            <h2>กรอกข้อมูลยา</h2>
            <br>
            <form action="medic_insert.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- data_id 
                <div class="form-group">
                    <label for="data_id" class="col-md-2 control-label">ลำดับ :</label>
                    <div class="col-md-10">-->
                        <input name="medicine_id" type="hidden" class="form-control" value="<?php echo $row_data2; ?>">
                    <!--</div>
                </div>-->
                
             
                
                <!-- alphabet -->
                <div class="form-group">
                    <label for="alphabet" class="col-md-2 control-label">ชื่อสมุนไพร :</label>
                    <div class="col-md-10">
                            <select name="alphabet" id="alphabet" class="form-control">
                                <option value="">-เลือกตัวอักษร-</option>
                                
                                    <!-- ดึงข้อมูลจากฐานข้อมูล -->
                                    <?php
                                        $sql_alphabet = "SELECT * FROM herb_alphabet";
                                        $res_alphabet = pg_query($db, $sql_alphabet);
                                    
                                        while($row_alphabet = pg_fetch_array($res_alphabet))
                                        {
                                            $alphabet_id = $row_alphabet['alphabet_id'];
                                            $alphabet_th = $row_alphabet['alphabet_th'];
                                            echo "<option value='$alphabet_id'>$alphabet_th</option>";
                                        }
                                    ?>
                                
                            </select>
                    </div>
                </div>

                
                
                <!-- name_medic -->
                <div class="form-group">
                    <label for="medicine_name" class="col-md-2 control-label">ชื่อยา :</label>
                    <div class="col-md-10">
                        <input name="medicine_name" type="text" class="form-control">
                    </div>
                </div>
                
                <!-- data_medic -->
                <div class="form-group">
                    <label for="medicine_data" class="col-md-2 control-label">วิธีการทำยา :</label>
                    <div class="col-md-10">
                        <textarea name="medicine_data" class="form-control" rows="9"></textarea>
                    </div>
                </div>

                <!-- data_image -->
                <div class="form-group">
                    <label for="medicine_img" class="col-md-2 control-label">รูปภาพ :</label>
                    <div class="col-md-10">
                        <input type="file" name="medicine_img" accept="image/*" required>
                    </div>
                </div>
                
                <!-- part -->
                <div class="form-group">
                    <label for="part_id" class="col-md-2 control-label">ส่วนที่ใช้ทำยา :</label>
                    <div class="col-md-10">
                        <select name="part_id" id="owner_id" class="form-control">
                                    <!-- ดึงข้อมูลจากฐานข้อมูล -->
                                    <?php
                                        while($rowPart = pg_fetch_row($queryPart))
                                        {
                                            echo "<option value='$rowPart[0]'>$rowPart[1]</option>"; 
                                        }
                                    ?>
                        </select>
                    </div>
                </div>


                <!-- herb_type -->
                   <div class="form-group">
                    <label for="type_id" class="col-md-2 control-label">ประเภทยา :</label>
                    <div class="col-md-10">
                        <select name="type_id" id="owner_id" class="form-control">
                                    <!-- ดึงข้อมูลจากฐานข้อมูล -->
                                    <?php
                                        while($rowType = pg_fetch_row($queryType))
                                        {
                                            echo "<option value='$rowType[0]'>$rowType[1]</option>"; 
                                        }
                                    ?>
                        </select>
                    </div>
                </div>
                
               

                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="herb_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                <br><br>
                
            </form>
            
        </div>
    </body>
</html>
