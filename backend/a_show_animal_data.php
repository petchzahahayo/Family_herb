<?php 
        require 'header_admin.php';
        
        //รับข้อมูล
        $animal_collect_id = $_GET['animal_collect_id'];


        $sql = "SELECT *  FROM animal_collect
                                INNER JOIN animal_data
                                ON animal_collect.animal_tumbon_id_collect = animal_data.animal_data_id
                                INNER JOIN animal_tumbon
                                ON animal_data.animal_data_id = animal_tumbon.animal_tumbon_id
                                  
                                INNER JOIN animal_type
                                ON animal_data.animal_type_id_animal_data = animal_type.animal_type_id
                            
                                WHERE animal_collect.animal_collect_id='$animal_collect_id'
                                ";
        $result = pg_query($db, $sql);       
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <!--<echo <?php $collect_lng; ?>-->
        <div class="container">
            <h2>ข้อมูลสัตว์ ที่ได้จากการสำรวจ</h2>
            <table class="table table-bordered">
                
                <!-- show data -->
                <?php while ($row = pg_fetch_array($result)){ ?>
                
                <tr >
                    <th class="info">ชื่อสัตว์</th>
                    <td><?php echo $row['animal_name_th']; ?></td>
                </tr>                               
                <tr>
                    <th class="info">ชื่ออังกฤษ</th>
                    <td><?php echo $row['animal_name_eng']; ?></td>
                </tr>
                <tr>
                    <th class="info">ชื่อวิทยาศาสตร์</th>
                    <td><?php echo $row['animal_name_science']; ?></td>
                </tr>

                <tr>
                    <th class="info">จุดสำรวจพบ</th>
                    <td><?php echo $row['animal_tumbon_name']; ?></td>
                </tr>
                  <tr>
                    <th class="info">จุดสังเกต</th>
                    <td><?php echo $row['animal_detail']; ?></td>
                </tr>
                <tr>
                    <th class="info">ประเภท</th>
                    <td><?php echo $row['animal_name_type']; ?></td>
                </tr>
                 <tr>
                    <th class="info">อธิบายลักษณะตามประเภท</th>
                    <td><?php echo $row['animal_type_more']; ?></td>
                </tr>
              
              
                <tr>
                    <th class="info">ความสูงของสัตว์</th>
                    <td><?php echo $row['animal_high']; ?> เซนติเมตร</td>
                </tr>
                <tr>
                    <th class="info">ความยาวของสัตว์</th>
                    <td><?php echo $row['animal_long']; ?> เซนติเมตร</td>
                </tr>
                <tr>
                  <th class="info">รูปภาพ</th>
                  <td><center>
                <img src="../images/<?php echo $row['collect_img']; ?>" style="width:300px;">
               </center> </td>
              </tr>
                <tr>
                    <th class="info">สถานที่</th>
                        <td>
                            
                            <div id="map" style="width: 300px; height: 300px;"></div>
                            <script>
                              var map;
                              var array_json = <?php echo $json ?>;
                              //alert(array_json[0].place_herb_lat);
                              
                              function initMap() 
                              {
                                var uluru = {lat: 14.96404430, lng: 101.94755060};
                                map = new google.maps.Map(document.getElementById('map'), {
                                  zoom: 8,
                                  center: uluru
                                });
                                selectLocation();
                              }
                              
                              var marker = [];
                              function selectLocation()
                              {
                                  for(var i=0; i < array_json.length; i++){
                                      var place_lat = array_json[i].place_lat;
                                      var place_lng = array_json[i].place_lng;
                                      var latlng = new google.maps.LatLng(place_lat, place_lng);
                                      //alert(place_herb_lat + place_herb_ng);
                                      var markeroption = {map: map, html: "", position: latlng};
                                      var marker = new google.maps.Marker(markeroption);
                                  } 
                              }
                              
                            </script>
                            <script async defer
                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8IYs5Jihd3Qgx6oY8BzwY5SZzQHlfwCI&callback=initMap">
                            </script>
 
                        </td>
                </tr>
                
                <?php } ?>
            </table>
            <!--
            <a href="frm_herb_add.php" class="btn btn-primary" >
                <span class="glyphicon glyphicon-plus"> เพิ่มสมุนไพร</span>
            </a>-->
            <a href="a_placeanimal_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
        </div>    
    </body>
</html>

