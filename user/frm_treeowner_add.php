<?php 
        require 'header_user.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
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
            <h2>กรอกข้อมูลเจ้าของสถานที่</h2>
            <br>
            <form action="treeowner_insert.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- owner_name -->
                <div class="form-group">
                    <label for="treeowner_name" class="col-md-2 control-label">ชื่อ :</label>
                    <div class="col-md-10">
                        <input name="treeowner_name" type="text" class="form-control" required>
                    </div>
                </div>
                
                <!-- owner_address -->
                <div class="form-group">
                    <label for="treeowner_address" class="col-md-2 control-label">ที่อยู่ :</label>
                    <div class="col-md-10">
                        <textarea name="treeowner_address" class="form-control" rows="5" required></textarea>
                    </div>
                </div>
                
                <!-- owner_image -->
                <div class="form-group">
                    <label for="treeowner_image" class="col-md-2 control-label">รูปภาพ :</label>
                    <div class="col-md-10">
                        <input type="file" name="treeowner_image" accept="image/*" required>
                    </div>
                </div>
                
                <!-- owner_age -->
                <div class="form-group">
                    <label for="treeowner_age" class="col-md-2 control-label">อายุ :</label>
                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" name="treeowner_age" value="ต่ำกว่า 20 ปี">ต่ำกว่า 20 ปี</label>
                        <label class="radio-inline"><input type="radio" name="treeowner_age" value="21 - 30 ปี">21 - 30 ปี</label>
                        <label class="radio-inline"><input type="radio" name="treeowner_age" value="31 - 40 ปี">31 - 40 ปี</label>
                        <label class="radio-inline"><input type="radio" name="treeowner_age" value="41 - 50 ปี">41 - 50 ปี</label>
                        <label class="radio-inline"><input type="radio" name="treeowner_age" value="50 ปีขึ้นไป">50 ปีขึ้นไป</label>
                    </div>
                </div>
                
                <!-- owner_education -->
                <div class="form-group">
                    <label for="treeowner_education" class="col-md-2 control-label">การศีกษา :</label>
                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" name="treeowner_education" value="ต่ำกว่า ม.3">ต่ำกว่า ม.3</label>
                        <label class="radio-inline"><input type="radio" name="treeowner_education" value="ม.3">ม.3</label>
                        <label class="radio-inline"><input type="radio" name="treeowner_education" value="ม.6">ม.6</label>
                        <label class="radio-inline"><input type="radio" name="treeowner_education" value="ป.ตรี">ป.ตรี</label>
                        <label class="radio-inline"><input type="radio" name="treeowner_education" value="ป.โท">ป.โท</label>
                        <label class="radio-inline"><input type="radio" name="treeowner_education" value="ป.เอก">ป.เอก</label>
                    </div>
                </div>
                
                <!-- owner_career -->
                <div class="form-group">
                    <label for="treeowner_career" class="col-md-2 control-label">อาชีพ :</label>
                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" name="treeowner_career" value="รับราชการ">รับราชการ</label>
                        <label class="radio-inline"><input type="radio" name="treeowner_career" value="พนักงานรัฐวิสาหกิจ">พนักงานรัฐวิสาหกิจ</label>
                        <label class="radio-inline"><input type="radio" name="treeowner_career" value="พนังานเอกชน">พนังานเอกชน</label>
                        <label class="radio-inline"><input type="radio" name="treeowner_career" value="รับจ้างทั่วไป">รับจ้างทั่วไป</label>
                        <label class="radio-inline"><input type="radio" name="treeowner_career" value="นักเรียน นักศึกษา">นักเรียน นักศึกษา</label>
                        <label class="radio-inline"><input type="radio" name="treeowner_career" value="ค้าขาย">ค้าขาย</label>
                        <label class="radio-inline">
                            <input type="radio" name="treeowner_career" value="อื่นๆ">อื่นๆ (โปรดระบุ) </label>
                            <input type="text" name="treeowner_career2" class="form-inline"> 
                        </label>
                    </div>
                </div>
                
                <!-- owner_revenue-->
                <div class="form-group">
                    <label for="treeowner_revenue" class="col-md-2 control-label">รายได้ :</label>
                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" name="treeowner_revenue" value="ต่ำกว่า 5,000 บาท">ต่ำกว่า 5,000 บาท</label>
                        <label class="radio-inline"><input type="radio" name="treeowner_revenue" value="5,001 - 10,000 บาท">5,001 - 10,000 บาท</label>
                        <label class="radio-inline"><input type="radio" name="treeowner_revenue" value="10,001 - 15,000 บาท">10,001 - 15,000 บาท</label>
                        <label class="radio-inline"><input type="radio" name="treeowner_revenue" value="15,001 - 20,000 บาท">15,001 - 20,000 บาท</label>
                        <label class="radio-inline"><input type="radio" name="treeowner_revenue" value="20,001 บาท ขึ้นไป">20,001 บาท ขึ้นไป</label>
                    </div>
                </div>
                
                <!-- owner_health-->
                <div class="form-group">
                    <label for="treeowner_health" class="col-md-2 control-label">โรคประจำตัว :</label>
                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" name="treeowner_health" value="ไม่มี">ไม่มี</label>
                        <label class="radio-inline">
                            <input type="radio" name="treeowner_health" value="มี">มี (โปรดระบุ) </label>
                            <input type="text" name="treeowner_health2" class="form-inline">
                        </label>
                    </div>
                </div>
                
                <!-- latitude -->
                <div class="form-group">
                    <label for="treeowner_lat" class="col-md-2 control-label">ละติจูด :</label>
                    <div class="col-md-10">
                        <input name="treeowner_lat" type="text" id="treeowner_lat" value="0" class="form-control" readonly>
                    </div>
                </div>
                
                
                <!-- longitude -->
                <div class="form-group">
                    <label for="treeowner_lng" class="col-md-2 control-label">ลองติจูด :</label>
                    <div class="col-md-10">
                        <input name="treeowner_lng" type="text" id="treeowner_lng" value="0" class="form-control" readonly>
                    </div>
                </div>
                
                <!-- Map -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <div id="map_canvas"></div>
                    </div>
                </div>
                
                <!-- googleMap -->
                <script src="../bootstrap/js/jquery.min.js"></script> 
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
                                                        content: 'คุณอยู่ที่นี่.'
                                                });
                                 
                                                var my_Point = infowindow.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
                                                //map.panTo(my_Point);  // ให้แผนที่แสดงไปที่ตัว marker       
                                                $("#treeowner_lat").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
                                                $("#treeowner_lng").val(my_Point.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value        
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
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="treeowner_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                <br><br>
                
            </form>
            
        </div>
    </body>
</html>
