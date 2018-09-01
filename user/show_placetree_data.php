<?php 
        require 'header_user.php';
        
        //รับข้อมูล
        $treeplace_id = $_GET['treeplace_id'];
        
        //คำสั่ง sql herb_owner
        $sqlOwner = "SELECT tree_owner.treeowner_name
                    FROM tree_owner
                    INNER JOIN tree_place
                    ON tree_owner.treeowner_id = tree_place.treeowner_id
                    WHERE treeplace_id='$treeplace_id'";
        $resultOwner = pg_query($db, $sqlOwner);
        
        //คำสั่ง sql herb_data
        $sqlData = "SELECT * FROM tree_name
                    INNER JOIN tree_data
                    ON tree_name.treename_id = tree_data.treename_id
                    INNER JOIN tree_typename
                    ON tree_data.treetype_id = tree_typename.treetype_id
                    INNER JOIN tree_place
                    ON tree_name.treename_id = tree_place.treename_id
                    WHERE treeplace_id='$treeplace_id'";
        $resultData = pg_query($db, $sqlData);
        
        //sql herb_place lat,lng
        $sql = "SELECT * FROM tree_place WHERE treeplace_id='$treeplace_id'";
        $result = pg_query($db, $sql);
        $arr_json = array();
        while($row = pg_fetch_array($result)){
            $treeplace_lat = $row['treeplace_lat'];
            $treeplace_lng = $row['treeplace_lng'];
            
            //array
            $arr = array();
            $arr['treeplace_lat'] = $treeplace_lat;
            $arr['treeplace_lng'] = $treeplace_lng;
            
            array_push($arr_json, $arr);
        }
        $json = json_encode($arr_json);
        //print_r($arr_json);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            <h2>ข้อมูลสถานที่</h2>
            <table class="table table-bordered">
                
                <!-- show data -->
                
                <tr>
                    <th class="info">ชื่อ</th>
                    <?php while($rowOwner = pg_fetch_array($resultOwner)){ ?>
                        <td><?php echo $rowOwner['treeowner_name']; ?></td>
                    <?php } ?>
                </tr>
                
                <tr>
                    <th class="info">ประเภทต้นไม้</th>
                    <?php while($rowData = pg_fetch_array($resultData)){ ?>
                        <td><?php echo $rowData['treetype_name']; ?></td>
                    
                </tr>
                
                
                
                <tr>
                    <th class="info">ความสูงของต้นไม้</th>
                    
                        <td><?php echo $rowData['treeplace_hight']; ?></td>
                    
                </tr>

                <tr>
                    <th class="info">ความกว้างของต้นไม้</th>
                    
                        <td><?php echo $rowData['treeplace_wideth']; ?></td>
                    
                </tr>

                  <tr>
                    <th class="info">เส้นรอยวงของต้นไม้</th>
                    
                        <td><?php echo $rowData['treeplace_radius']; ?></td>
                    
                </tr>

                <?php } ?>
                <!-- map -->
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
                                      var treeplace_lat = array_json[i].treeplace_lat;
                                      var treeplace_lng = array_json[i].treeplace_lng;
                                      var latlng = new google.maps.LatLng(treeplace_lat, treeplace_lng);
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
                
            </table>
            
            <a href="placetree_manage.php" class="btn btn-danger" >
                กลับหน้าหลัก
            </a>
        </div>    
    </body>
</html>

