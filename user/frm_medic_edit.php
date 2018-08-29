<?php
        require 'header_user.php';
        
        //รับค่า
        $medic_id = $_GET['medicine_id'];
        
        //คำสั่ง sql
        $sql = "SELECT * FROM medicine WHERE medicine_id='$medic_id'";
        $result = pg_query($db, $sql);
        $row = pg_fetch_array($result);
        
        //herb_data
        $sqlData = "SELECT * FROM herb_name";
        $resData = pg_query($db, $sqlData);
        
        //sql herb_type
        $sqlType = "SELECT * FROM medicine_type";
        $queryType = pg_query($db, $sqlType);

        $sqlPart = "SELECT * FROM herb_part";
        $queryPart = pg_query($db, $sqlPart);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            <h2>แก้ไขข้อมูลยา</h2>
            <br>
            <form action="medic_edit.php" method="POST" enctype="multipart/form-data" class="form-horizontal">


                <!-- name_th -->
                <div class="form-group">
                    <label for="name_id" class="col-md-2 control-label">ชื่อสมุนไพร :</label>
                    <div class="col-md-10">
                        <select name="name_id" class="form-control">

                            <!-- ดึงข้อมูลจากฐานข้อมูล -->
                            <?php
                            while ($rowData = pg_fetch_row($resData)) {
                                if ($rowData[0] == $row['name_id']) {
                                    echo "<option value='$rowData[0]' selected>$rowData[1]</option>";
                                } else {
                                    echo "<option value='$rowData[0]'>$rowData[1]</option>";
                                }
                            }
                            ?>

                        </select>
                    </div>
                </div>

                <!-- name_medic -->
                <div class="form-group">
                    <label class="col-md-2 control-label">ชื่อยา :</label>
                    <div class="col-md-10">
                        <input name="medicine_name" type="text" class="form-control" value="<?php echo $row['medicine_name']; ?>">
                    </div>
                </div>
                
                
                 <!-- data_detail -->
                 <div class="form-group">
                    <label class="col-md-2 control-label">ข้อมูลยา :</label>
                    <div class="col-md-10">
                        <textarea name="medicine_data" class="form-control" rows="5">
                            <?php echo $row['medicine_data']; ?>
                        </textarea>
                    </div>
                </div>

                <!-- images -->
                <div class="form-group">
                    <label for="medicine_img" class="col-md-2 control-label">รูปภาพ :</label>
                    <div class="col-md-10">
                        <img src="../images/<?php echo $row['medicine_img']; ?>" style="width:150px;height:150px;"><br><br>
                        <input type="file" name="medicine_img">
                    </div>
                </div>


                <!-- herb_type -->
                <div class="form-group">
                    <label for="part_id" class="col-md-2 control-label">ส่วนที่ใช้ :</label>
                    <div class="col-md-10">
                        <select name="part_id" id="owner_id" class="form-control">
                            
                            <!-- ดึงข้อมูลจากฐานข้อมูล -->
                            <?php
                            while ($rowPart = pg_fetch_row($queryPart)) {
                                if ($rowPart[0] == $row['part_id']) {
                                    echo "<option value='$rowPart[0]' selected>$rowPart[1]</option>";
                                } else {
                                    echo "<option value='$rowPart[0]'>$rowPart[1]</option>";
                                }
                            }
                            ?>
                                    
                        </select>
                    </div>
                </div>

                   <!-- herb_type -->
                   <div class="form-group">
                    <label for="type_id" class="col-md-2 control-label">ประเภทสมุนไพร :</label>
                    <div class="col-md-10">
                        <select name="type_id" id="owner_id" class="form-control">
                            
                            <!-- ดึงข้อมูลจากฐานข้อมูล -->
                            <?php
                            while ($rowType = pg_fetch_row($queryType)) {
                                if ($rowType[0] == $row['type_id']) {
                                    echo "<option value='$rowType[0]' selected>$rowType[1]</option>";
                                } else {
                                    echo "<option value='$rowType[0]'>$rowType[1]</option>";
                                }
                            }
                            ?>
                                    
                        </select>
                    </div>
                </div>
                
                
                
                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="hidden" name="medicine_id" value="<?php echo $row['medicine_id'] ?>">
                        <button type="submit" class="btn btn-primary">แก้ไข</button>
                        <a href="medic_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                
            </form>
        </div>
    </body>
</html>
