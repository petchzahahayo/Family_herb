<?php 
        require 'header_admin.php';
        
          //anmal
        $sqldata = "SELECT * FROM animal_data";
        $resdata = pg_query($db, $sqldata);

        //tumbon
        $sqltumbon = "SELECT * FROM animal_tumbon";
        $restumbon = pg_query($db, $sqltumbon);
        
        //name ++
        $sql_collect = "SELECT MAX(animal_collect_id) FROM animal_collect";
        $res_collect = pg_query($db, $sql_collect);
        $row_collect = pg_fetch_row($res_collect);
        $row_collect1 = $row_collect[0];
        $row_collect2 = $row_collect1 + 1;
        
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="script.js" type="text/javascript"></script>
        <style type="text/css">
            /* css กำหนดความกว้าง ความสูงของแผนที่ */
            #map_canvas { 
                width:100%;
                height:400px;
                margin:auto;
            /*  margin-top:100px;*/
            }
        </style>
    </head>
    
    <body>
        <div class="container">
            <h2>กรอกข้อมูลสัตว์ที่พบ</h2>
            <br>
            <form action="a_animal_collect_insert.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- place_id -->
                <input name="animal_collect_id" type="hidden" value="<?php echo $row_collect2; ?>">

                <!-- owner_name -->
                <div class="form-group">
                    <label for="animal_data_id_collect" class="col-md-2 control-label">สัตว์ที่พบ :</label>
                                                             <!--  ชื่อเจ้าของสมุนไฟร -->
                    <div class="col-md-10">
                        <select name="animal_data_id_collect" id="animal_data_id_collect" class="form-control" required>
                            <option value="">--ชื่อสัตว์--</option>
                                
                                    <!-- ดึงข้อมูลจากฐานข้อมูล -->
                                    <?php
                                        while($rowdata = pg_fetch_row($resdata))
                                        {
                                            echo "<option value='$rowdata[0]'>$rowdata[1]</option>"; 
                                        }
                                    ?>
                                
                        </select>
                    </div>
                </div>
                
                <!-- alphabet -->
               <div class="form-group">
                    <label for="animal_tumbon_id_collect" class="col-md-2 control-label">ชุมชนที่สำรวจพบ :</label>
                                                             <!--  ชื่อเจ้าของสมุนไฟร -->
                    <div class="col-md-10">
                        <select name="animal_tumbon_id_collect" id="animal_tumbon_id_collect" class="form-control" required>
                            <option value="">--เลือกชุมชนที่สำรวจ--</option>
                                
                                    <!-- ดึงข้อมูลจากฐานข้อมูล -->
                                    <?php
                                        while($rowtumbon = pg_fetch_row($restumbon))
                                        {
                                            echo "<option value='$rowtumbon[0]'>$rowtumbon[1]</option>"; 
                                        }
                                    ?>
                                
                        </select>
                    </div>
                </div>
                <!-- data_image -->
                <div class="form-group">
                    <label for="collect_img" class="col-md-2 control-label">รูปภาพ :</label>
                    <div class="col-md-10">
                        <input type="file" name="collect_img" accept="image/*" required>
                    </div>
                </div>
                
                <!-- Map -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <div id="map_canvas"></div>
                    </div>
                </div>

                <!-- latitude -->
                <div class="form-group">
                    <label for="collect_lat" class="col-md-2 control-label">ละติจูด :</label>
                    <div class="col-md-10">
                        <input name="collect_lat" type="text" id="collect_lat" value="0" class="form-control" required>
                    </div>
                </div>
                
                
                <!-- longitude -->
                <div class="form-group">
                    <label for="collect_lng" class="col-md-2 control-label">ลองติจูด :</label>
                    <div class="col-md-10">
                        <input name="collect_lng" type="text" id="collect_lng" value="0" class="form-control" required>
                    </div>
                </div>
                
                <!-- googleMap -->
                <script>
                    var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
                    var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
                    function initialize() { // ฟังก์ชันแสดงแผนที่
                            GGM = new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
                            // กำหนดจุดเริ่มต้นของแผนที่
                            var my_Latlng  = new GGM.LatLng(14.951142, 102.178896);
                            var my_mapTypeId = GGM.MapTypeId.ROADMAP; // กำหนดรูปแบบแผนที่ที่แสดง
                            // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas
                            var my_DivObj = $("#map_canvas")[0];
                            // กำหนด Option ของแผนที่
                            var myOptions = {
                                    zoom: 15, // กำหนดขนาดการ zoom
                                    center: my_Latlng, // กำหนดจุดกึ่งกลาง
                                    mapTypeId: my_mapTypeId // กำหนดรูปแบบแผนที่
                            };
                            map = new GGM.Map(my_DivObj, myOptions);// สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map

                            // เรียกใช้คุณสมบัติ ระบุตำแหน่ง ของ html 5 ถ้ามี
                            if (navigator.geolocation) {
                                        navigator.geolocation.getCurrentPosition(function (position) {
                                                var pos = new GGM.LatLng(position.coords.latitude, position.coords.longitude);
                                                var infowindow = new GGM.InfoWindow({
                                                        map: map,
                                                        position: pos,
                                                        content: 'จุดที่คุณอยู่'
                                                });
                                 
                                                var my_Point = infowindow.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
                                                //map.panTo(my_Point);  // ให้แผนที่แสดงไปที่ตัว marker       
                                                $("#collect_lat").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
                                                $("#collect_lng").val(my_Point.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value        
                                                map.setCenter(pos);
                                        }, function () {
                                                // คำสั่งทำงาน ถ้า ระบบระบุตำแหน่ง geolocation ผิดพลาด หรือไม่ทำงาน
                                        });
                            } else {
                                     // คำสั่งทำงาน ถ้า บราวเซอร์ ไม่สนับสนุน ระบุตำแหน่ง
                            }
                   
                            // กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom
                            GGM.event.addListener(map, 'zoom_changed', function () {
                                    $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value  
                            });
                    }
                    $(function () {
                            // โหลด สคริป google map api เมื่อเว็บโหลดเรียบร้อยแล้ว
                            // ค่าตัวแปร ที่ส่งไปในไฟล์ google map api
                            // v=3.2&sensor=false&language=th&callback=initialize
                            //  v เวอร์ชัน่ 3.2
                            //  sensor กำหนดให้สามารถแสดงตำแหน่งทำเปิดแผนที่อยู่ได้ เหมาะสำหรับมือถือ ปกติใช้ false
                            //  language ภาษา th ,en เป็นต้น
                            //  callback ให้เรียกใช้ฟังก์ชันแสดง แผนที่ initialize
                            $("<script/>", {
                                  "type": "text/javascript",
                                  src: "https://maps.googleapis.com/maps/api/js?key=AIzaSyBjSSLVC9Mpi8wMLUoJNb-zSrHzlGkXYPs&callback=initialize"
                            }).appendTo("body");    
                    });
                </script>
        
                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-save"></span>
                        บันทึก</button>
                        <a href="a_placeanimal_manage.php" class="btn btn-danger">
                            กลับหน้าหลัก
                        </a>
                    </div>
                </div>
                <br><br>
                
            </form>
            
        </div>
    </body>
</html>
